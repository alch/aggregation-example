<?php

namespace App\Modules\Shared\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Id implements \Stringable
{
    protected UuidInterface $id;

    protected function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function new(): static
    {
        return new static(Uuid::uuid4());
    }

    public static function fromUuid4String(string $uuid4): static
    {
        return new static(Uuid::fromString($uuid4));
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }
}
