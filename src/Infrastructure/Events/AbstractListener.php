<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events;

abstract class AbstractListener implements ListenerInterface
{
    /**
     * @const string
     */
    private const ON = 'on%s';

    /**
     * {@inheritDoc}
     */
    public function listen(EventInterface $event): void
    {
        $this->{sprintf(self::ON, $event)}($event);
    }
}
