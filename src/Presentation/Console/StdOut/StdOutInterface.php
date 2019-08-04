<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut;

use GraphicEditor\Domain\Shape\ShapeInterface;

interface StdOutInterface
{
    // display something to the STDOUT
    public function display(ShapeInterface $shape): void;
}
