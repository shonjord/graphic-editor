<?php declare(strict_types=1);

namespace GraphicEditor\Application\Services;

use GraphicEditor\Domain\Shape\ShapeInterface;

interface TracerInterface
{
    // draws a shape
    public function trace(ShapeInterface $shape): void;
}
