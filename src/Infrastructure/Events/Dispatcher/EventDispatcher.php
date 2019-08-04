<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Dispatcher;

use GraphicEditor\Infrastructure\Events\EventInterface;
use GraphicEditor\Infrastructure\Events\ListenerInterface;
use InvalidArgumentException;

final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array
     */
    private $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(EventInterface $event): void
    {
        $class = $event->getClass();

        if ($this->classIsUnknown($class)) {
            throw new InvalidArgumentException(sprintf(
                "the following class does not have any events: %s",
                $class
            ));
        }

        array_walk($this->events[$class], function (ListenerInterface $listener) use ($event) : void {
            $listener->listen($event);
        });
    }

    // verifies if the given class exists in the events collection
    private function classIsUnknown(string $class): bool
    {
        return !array_key_exists($class, $this->events);
    }
}
