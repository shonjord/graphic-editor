<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Domain\Shape\Exception\ShapeIsNotSupportedException;
use GraphicEditor\Infrastructure\Events\AbstractListener;

final class VerifyShapeOutputsSubscriber extends AbstractListener
{
    /**
     * @var array
     */
    private $outputs;

    public function __construct(array $outputs)
    {
        $this->outputs = $outputs;
    }

    /**
     * verifies the integrity of the input
     *
     * @param ShapeInputWasReceived $event
     * @throws ShapeIsNotSupportedException
     */
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyColor(
            $event->getInput()->getOutputValue()
        );
    }

    /**
     * checks if the given value is supported by the app
     *
     * @param string $output
     * @throws ShapeIsNotSupportedException
     */
    private function verifyColor(string $output): void
    {
        if (!in_array($output, $this->outputs)) {
            throw new ShapeIsNotSupportedException($output);
        }
    }
}
