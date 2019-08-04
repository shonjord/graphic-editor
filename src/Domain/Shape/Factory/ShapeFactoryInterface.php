<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\Factory;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Infrastructure\Reader\Console\InputInterface;
use Throwable;

interface ShapeFactoryInterface
{
    /**
     * Generates a new shape with the given input
     *
     * @param InputInterface $input
     * @return ShapeInterface
     * @throws Throwable
     */
    public function buildFromInput(InputInterface $input): ShapeInterface;
}
