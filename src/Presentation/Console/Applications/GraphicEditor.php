<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\Applications;

use GraphicEditor\Application\Services\TracerInterface;
use GraphicEditor\Domain\Shape\Factory\ShapeFactoryInterface;
use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Infrastructure\Reader\Console\InputInterface;
use GraphicEditor\Infrastructure\Reader\Console\InputReaderInterface;
use GraphicEditor\Presentation\Console\ConsoleInterface;

final class GraphicEditor implements ConsoleInterface
{
    /**
     * @var ShapeFactoryInterface
     */
    private $factory;

    /**
     * @var InputReaderInterface
     */
    private $reader;

    /**
     * @var TracerInterface
     */
    private $tracer;

    public function __construct(ShapeFactoryInterface $factory, InputReaderInterface $reader, TracerInterface $tracer)
    {
        $this->factory = $factory;
        $this->reader = $reader;
        $this->tracer = $tracer;
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $shapes = [];
        $this->hydrateArrayWithShapes($shapes);
        $this->drawShapes($shapes);
    }

    // hydrates the given array with shapes
    private function hydrateArrayWithShapes(array &$shapes): void
    {
        array_walk($this->reader->read(), function (InputInterface $input) use (&$shapes) : void {
            $shapes[] = $this->factory->buildFromInput($input);
        });
    }

    // draw the shapes to STDOUT
    private function drawShapes(array $shapes): void
    {
        array_walk($shapes, function (ShapeInterface $shape) : void {
            $this->tracer->trace($shape);
        });
    }
}
