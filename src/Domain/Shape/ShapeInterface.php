<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape;

use GraphicEditor\Domain\Shape\ValueObject\Border;
use GraphicEditor\Domain\Shape\ValueObject\Color;
use GraphicEditor\Domain\Shape\ValueObject\Output;
use GraphicEditor\Domain\Shape\ValueObject\Size;

interface ShapeInterface
{
    // returns a color of $this shape
    public function getColor(): Color;

    // returns a size of $this shape
    public function getSize(): Size;

    // returns a border of $this shape
    public function getBorder(): Border;

    // returns an output of $this image
    public function getOutput(): Output;

    // returns a string representation of $this shape
    public function __toString(): string;
}
