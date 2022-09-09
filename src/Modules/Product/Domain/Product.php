<?php

namespace App\Modules\Product\Domain;

use App\Modules\Product\Domain\Event\CategoryWasAddedToProduct;
use App\Modules\Product\Domain\Event\ProductWasCreated;
use App\Modules\Shared\Domain\Aggregate;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class Product extends Aggregate
{
    protected Id $id;
    protected SimpleString $name;
    /** @var iterable<Category> */
    protected iterable $categories = [];

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): SimpleString
    {
        return $this->name;
    }

    public function categories(): iterable
    {
        return $this->categories;
    }

    /**
     * @param Id $id
     * @param SimpleString $name
     *
     * @return void
     */
    public static function create(
        Id $id,
        SimpleString $name
    ): static {
        $self = new static();
        $self->recordThat(new ProductWasCreated($id, $name));

        return $self;
    }

    /**
     * FIXME: when reconstructing, we'll only have a collection of
     * FIXME: category IDs. Cant's find a way to "expand" IDs to the
     * FIXME: actual Entity in product::categories.
     *
     * FIXME: An additional problem lies in using this class both as an
     * FIXME: event-sourced aggregate Root AND a Doctrine Entity. In fact
     * FIXME: product::categories is defined as a many-to-many relation in
     * FIXME: the doctrine mapping file. SOLVE THOSE TWO PROBLEMS!
     * @param Category $category
     *
     * @return void
     */
    public function addCategory(Category $category): void
    {
        $this->recordThat(new CategoryWasAddedToProduct($this->id, $category->id()));
    }

    protected function applyProductWasCreated(ProductWasCreated $event): void
    {
        $this->id = $event->id();
        $this->name = $event->name();
    }

    protected function applyCategoryWasAddedToProduct(CategoryWasAddedToProduct $event): void
    {
        $this->categories[] = $event->categoryId();
    }

    public function __toString(): string
    {
        return sprintf(
            'id:%s, name:%s, categories:%s',
            $this->id,
            $this->name,
            implode(
                ',',
                array_map(
                    fn(Id $c) => sprintf('[id:%s]', $c),
                    $this->categories
                )
            )
        );
    }
}
