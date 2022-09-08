<?php

namespace App\Modules\Product\Infrastructure\Persistence\Doctrine\Types;

use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class SimpleStringType extends StringType
{
    const ID = 'SimpleString';

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return SimpleString
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): SimpleString
    {
        return SimpleString::fromStringValue($value);
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
