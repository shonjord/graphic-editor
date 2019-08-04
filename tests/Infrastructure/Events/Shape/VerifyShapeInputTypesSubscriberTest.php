<?php declare(strict_types=1);

namespace Test\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapeInputTypesSubscriber;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class VerifyShapeInputTypesSubscriberTest extends TestCase
{
    public function testThatExceptionIsThrownWhenTypeIsInvalid(): void
    {
        $listener = new VerifyShapeInputTypesSubscriber();
        $input = new ShapeInput([
            'params' => [
                'size' => 'foo',
                'border' => 'bar',
            ]
        ]);

        $this->expectException(InvalidArgumentException::class);
        $listener->listen(new ShapeInputWasReceived($input));
    }
}
