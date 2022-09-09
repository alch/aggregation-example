<?php

namespace App\Modules\Shared\Domain;

use App\Modules\Shared\Domain\Event\Event;

class Aggregate
{
    private const APPLY = 'apply';

    /** @var iterable<Event> */
    protected iterable $uncommittedEvents;

    protected function __construct()
    {
    }

    protected function recordThat(Event $event): void
    {
        $this->apply($event);
        $this->uncommittedEvents[] = $event;
    }

    protected function apply(Event $event): void
    {
        $methodName = sprintf(
            '%s%s',
            self::APPLY,
            end(...[explode('\\', $event::class)])
        );

        if (!method_exists($this, $methodName)) {
            return;
        }

        $this->$methodName($event);
    }
}
