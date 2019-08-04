<?php declare(strict_types=1);

namespace Test\Infrastructure\Events\Shape;

use GraphicEditor\Domain\Shape\Circle\Entity\Circle;
use GraphicEditor\Domain\Shape\Exception\ShapeIsNotSupportedException;
use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapesSubscriber;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;
use PHPUnit\Framework\TestCase;

final class VerifyShapeSubscriberTest extends TestCase
{
    public function testThatExceptionIsThrownWhenShapeIsUnknown(): void
    {
        $listener = new VerifyShapesSubscriber([
            'circle' => Circle::class
        ]);

        $input = new ShapeInput([
            'type' => 'foo'
        ]);

        $this->expectException(ShapeIsNotSupportedException::class);
        $listener->listen(new ShapeInputWasReceived($input));
    }
}
