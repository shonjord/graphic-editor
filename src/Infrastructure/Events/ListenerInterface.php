<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events;

interface ListenerInterface
{
    // listens the given event
    public function listen(EventInterface $event): void;
}
