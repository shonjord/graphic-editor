<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Dispatcher;

use GraphicEditor\Infrastructure\Events\EventInterface;
use Throwable;

interface EventDispatcherInterface
{
    /**
     * Dispatch an event so the listeners can perform their task on the event
     *
     * @param EventInterface $event
     * @return void
     * @throws Throwable
     */
    public function dispatch(EventInterface $event): void;
}
