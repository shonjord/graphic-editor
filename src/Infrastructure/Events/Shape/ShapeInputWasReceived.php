<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\EventInterface;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;

final class ShapeInputWasReceived implements EventInterface
{
    /**
     * @var ShapeInput
     */
    private $input;

    public function __construct(ShapeInput $input)
    {
        $this->input = $input;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return 'ShapeInputWasReceived';
    }

    /**
     * {@inheritDoc}
     */
    public function getClass(): string
    {
        return ShapeInputWasReceived::class;
    }

    // returns the arguments of the inputs
    public function getInput(): ShapeInput
    {
        return $this->input;
    }
}
