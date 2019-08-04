<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape;

use GraphicEditor\Domain\Shape\ValueObject\Border;
use GraphicEditor\Domain\Shape\ValueObject\Color;
use GraphicEditor\Domain\Shape\ValueObject\Output;
use GraphicEditor\Domain\Shape\ValueObject\Size;

abstract class AbstractShape implements ShapeInterface
{
    /**
     * @var Color
     */
    protected $color;

    /**
     * @var Size
     */
    protected $size;

    /**
     * @var Border
     */
    protected $border;

    /**
     * @var Output
     */
    protected $output;

    public function __construct(Color $color, Size $size, Border $border, Output $output)
    {
        $this->color = $color;
        $this->size = $size;
        $this->border = $border;
        $this->output = $output;
    }

    /**
     * {@inheritDoc}
     */
    public function getColor(): Color
    {
        return $this->color;
    }

    /**
     * {@inheritDoc}
     */
    public function getSize(): Size
    {
        return $this->size;
    }

    /**
     * {@inheritDoc}
     */
    public function getBorder(): Border
    {
        return $this->border;
    }

    /**
     * {@inheritDoc}
     */
    public function getOutput(): Output
    {
        return $this->output;
    }
}
