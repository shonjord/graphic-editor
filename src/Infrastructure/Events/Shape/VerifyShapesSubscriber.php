<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\AbstractListener;
use InvalidArgumentException;

final class VerifyShapesSubscriber extends AbstractListener
{
    /**
     * @var array
     */
    private $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    // verifies the integrity of the input
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyShape(
            $event->getInput()->getType()
        );
    }

    // checks if the given value is supported by the app
    private function verifyShape(string $shape): void
    {
        if (!array_key_exists($shape, $this->shapes)) {
            throw new InvalidArgumentException(sprintf(
                'the following shape is not supported: %s',
                $shape
            ));
        }
    }
}
