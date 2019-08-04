<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events;

interface EventInterface
{
    // returns the class of the event, usually the type of event (e.g: InputWasReceived)
    public function getClass(): string;

    // returns a string representation of the event
    public function __toString(): string;
}
