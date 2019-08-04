<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\AbstractListener;
use InvalidArgumentException;

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

    // verifies the integrity of the input
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyColor(
            $event->getInput()->getOutputValue()
        );
    }

    // checks if the given value is supported by the app
    private function verifyColor(string $output): void
    {
        if (!in_array($output, $this->outputs)) {
            throw new InvalidArgumentException(sprintf(
                'the following output is not supported: %s',
                $output
            ));
        }
    }
}
