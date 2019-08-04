<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape;

use GraphicEditor\Domain\Shape\ShapeInterface;

abstract class AbstractShapeStdOut
{
    /**
     * @var array
     */
    protected $colors;

    public function __construct(array $colors)
    {
        $this->colors = $colors;
    }

    // writes to STDOUT
    protected function write(string $value): void
    {
        fwrite(STDOUT, $value);
    }

    protected function writeEmptyLine(): void
    {
        $this->write("\n");
    }

    // returns the color of the shape
    protected function colorOf(ShapeInterface $shape): string
    {
        return $this->colors[(string) $shape->getColor()];
    }

    // returns a clear color for the STDOUT
    protected function clearColor(): string
    {
        return $this->colors['clear'];
    }
}
