<?php declare(strict_types=1);

namespace GraphicEditor\Application\Services\Shape;

use GraphicEditor\Application\Services\TracerInterface;
use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;

final class ShapeTracer implements TracerInterface
{
    /**
     * @var array
     */
    private $stdout;

    public function __construct(array $stdout)
    {
        $this->stdout = $stdout;
    }

    /**
     * {@inheritDoc}
     */
    public function trace(ShapeInterface $shape): void
    {
        $stdout = $this->retrieveStdOutOfShape($shape);
        $stdout->display($shape);
    }

    // retrieves the correspondent STDOUT for the given shape
    private function retrieveStdOutOfShape(ShapeInterface $shape): StdOutInterface
    {
        return $this->stdout[(string) $shape->getOutput()][(string) $shape];
    }
}
