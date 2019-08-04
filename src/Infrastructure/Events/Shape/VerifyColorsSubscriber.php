<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\AbstractListener;
use InvalidArgumentException;

final class VerifyColorsSubscriber extends AbstractListener
{
    /**
     * @var array
     */
    private $colors;

    public function __construct(array $colors)
    {
        $this->colors = $colors;
    }

    // verifies the integrity of the input
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyColor(
            $event->getInput()->getColorValue()
        );
    }

    // checks if the given value is supported by the app
    private function verifyColor(string $color): void
    {
        if (!array_key_exists($color, $this->colors)) {
            throw new InvalidArgumentException(sprintf(
                'the following color is not supported: %s',
                $color
            ));
        }
    }
}
