<?php declare(strict_types=1);

namespace Test\Infrastructure\Events\Dispatcher;

use GraphicEditor\Infrastructure\Events\Dispatcher\EventDispatcher;
use GraphicEditor\Infrastructure\Events\EventInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class EventDispatcherTest extends TestCase
{
    public function testThatExceptionIsThrownWhenClassIsUnknown(): void
    {
        $event = new class implements EventInterface {
            public function getClass(): string
            {
                return 'foo';
            }

            public function __toString(): string
            {
                return 'foo';
            }
        };

        $dispatcher = new EventDispatcher([
            'bar' => [
                'class' => 'test'
            ]
        ]);

        $this->expectException(InvalidArgumentException::class);
        $dispatcher->dispatch($event);
    }
}
