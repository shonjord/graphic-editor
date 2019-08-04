<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Reader\Console;

final class ShapeInput implements InputInterface
{
    /**
     * @var array
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    // returns the raw input
    public function getRawInput(): array
    {
        return $this->input;
    }

    // returns the current type of the input, e.g: circle
    public function getType(): string
    {
        return $this->input['type'];
    }

    // returns the color from the params
    public function getColorValue(): string
    {
        return $this->input['params']['color'];
    }

    // returns the size from the params
    public function getSizeValue(): int
    {
        return (int) $this->input['params']['size'];
    }

    // returns the border from the params
    public function getBorderValue(): int
    {
        return (int) $this->input['params']['border'];
    }

    // returns output of the shape (array of points, image, etc)
    public function getOutputValue(): string
    {
        return $this->input['params']['output'];
    }
}
