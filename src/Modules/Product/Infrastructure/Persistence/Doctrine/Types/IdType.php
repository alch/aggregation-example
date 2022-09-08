<?php

namespace App\Modules\Product\Infrastructure\Persistence\Doctrine\Types;

use App\Modules\Shared\Domain\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IdType extends GuidType
{
    const ID = 'Id';

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Id
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Id
    {
        return Id::fromUuid4String($value);
    }

    /**
     * @param Id $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->__toString();
    }

    public function getName(): string
    {
        return self::ID;
    }
}
