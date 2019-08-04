<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Domain\Shape\Exception\ColorIsNotSupportedException;
use GraphicEditor\Infrastructure\Events\AbstractListener;

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

    /**
     * verifies the integrity of the input
     *
     * @param ShapeInputWasReceived $event
     * @throws ColorIsNotSupportedException
     */
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $this->verifyColor(
            $event->getInput()->getColorValue()
        );
    }

    /**
     * checks if the given value is supported by the app
     *
     * @param string $color
     * @throws ColorIsNotSupportedException
     */
    private function verifyColor(string $color): void
    {
        if (!array_key_exists($color, $this->colors)) {
            throw new ColorIsNotSupportedException($color);
        }
    }
}
