<?php

namespace App\Modules\Shared\Domain;

class SimpleString implements \Stringable
{
    protected string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromStringValue(string $value): static
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
