<?php

namespace App\Modules\Shared\Infrastructure\Persistence\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsManagedEntity
{
    public function __construct(
        public string $entityClassName
    ) {
    }
}
