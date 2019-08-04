<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Domain\Shape\Exception\ShapeIsNotSupportedException;
use GraphicEditor\Infrastructure\Events\AbstractListener;

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

    /**
     * verifies the integrity of the input
     *
     * @param ShapeInputWasReceived $event
     * @throws ShapeIsNotSupportedException
     */
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyShape(
            $event->getInput()->getType()
        );
    }

    /**
     * checks if the given value is supported by the app
     * @param string $shape
     * @throws ShapeIsNotSupportedException
     */
    private function verifyShape(string $shape): void
    {
        if (!array_key_exists($shape, $this->shapes)) {
            throw new ShapeIsNotSupportedException($shape);
        }
    }
}
