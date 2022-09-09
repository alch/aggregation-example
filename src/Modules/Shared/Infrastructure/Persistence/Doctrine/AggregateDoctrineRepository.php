<?php

namespace App\Modules\Shared\Infrastructure\Persistence\Doctrine;

use App\Modules\Product\Domain\CategoryRepository;
use App\Modules\Product\Domain\Exception\NotFound;
use App\Modules\Shared\Domain\Aggregate;
use App\Modules\Shared\Domain\AggregateRepository;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Infrastructure\Persistence\Attribute\AsManagedEntity;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use ReflectionException;

abstract class AggregateDoctrineRepository implements AggregateRepository
{
    private ManagerRegistry $doctrine;
    protected string $entityClassName;

    /**
     * @throws ReflectionException
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->entityClassName = $this->managedClassNameFromAnnotations();
    }

    private function repository(): ObjectRepository
    {
        return $this->doctrine
            ->getRepository(
                $this->entityClassName
            );
    }

    public function byId(Id $id): Aggregate
    {
        return $this->repository()->find($id) ??
            throw new NotFound(
                sprintf(
                    'Aggregate %s id:%s not found.',
                    $this->managedClassNameFromAnnotations(),
                    $id
                )
            );
    }

    public function add(Aggregate $aggregate): void
    {
        $this->doctrine->getManager()->persist($aggregate);
    }

    public function remove(Aggregate $aggregate): void
    {
        $this->doctrine->getManager()->remove($aggregate);
    }

    /**
     * @throws ReflectionException
     */
    protected function managedClassNameFromAnnotations(): string
    {
        $class = static::class;

        if ($attribute = (new \ReflectionClass($class))->getAttributes(AsManagedEntity::class)) {
            return $attribute[0]->newInstance()->entityClassName;
        } else {
            throw new \InvalidArgumentException(
                sprintf('You must specify entityClassName (%s)', static::class)
            );
        }
    }
}
