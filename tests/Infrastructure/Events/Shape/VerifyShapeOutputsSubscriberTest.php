<?php declare(strict_types=1);

namespace Test\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapeOutputsSubscriber;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;
use GraphicEditor\Presentation\Console\StdOut\Shape\Exception\OutputIsNotSupportedException;
use PHPUnit\Framework\TestCase;

final class VerifyShapeOutputsSubscriberTest extends TestCase
{
    public function testThatExceptionIsThrownWhenOutputIsUnknown(): void
    {
        $listener = new VerifyShapeOutputsSubscriber(['pattern', 'image']);
        $input = new ShapeInput([
            'params' => [
                'output' => 'foo'
            ]
        ]);

        $this->expectException(OutputIsNotSupportedException::class);
        $listener->listen(new ShapeInputWasReceived($input));
    }
}
