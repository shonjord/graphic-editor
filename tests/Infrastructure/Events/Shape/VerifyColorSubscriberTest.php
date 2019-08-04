<?php declare(strict_types=1);

namespace Test\Infrastructure\Events\Shape;

use GraphicEditor\Domain\Shape\Exception\ColorIsNotSupportedException;
use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use GraphicEditor\Infrastructure\Events\Shape\VerifyColorsSubscriber;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;
use PHPUnit\Framework\TestCase;

final class VerifyColorSubscriberTest extends TestCase
{
    public function testThatExceptionIsThrownWhenColorIsUnknown(): void
    {
        $listener = new VerifyColorsSubscriber(['red', 'blue']);
        $input = new ShapeInput([
            'params' => [
                'color' => 'foo'
            ]
        ]);

        $this->expectException(ColorIsNotSupportedException::class);
        $listener->listen(new ShapeInputWasReceived($input));
    }
}
