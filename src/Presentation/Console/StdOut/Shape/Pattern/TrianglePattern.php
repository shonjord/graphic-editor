<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Pattern;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;
use GraphicEditor\Presentation\Console\StdOut\Shape\AbstractShapeStdOut;

final class TrianglePattern extends AbstractShapeStdOut implements StdOutInterface
{
    /**
     * {@inheritDoc}
     */
    public function display(ShapeInterface $shape): void
    {
        $n = $shape->getSize()->getValue();
        $k = 2 * $n - 2;

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $k; $j++) {
                $this->write(" ");
            }
            $k = $k - 1;
            for ($j = 0; $j <= $i; $j++) {
                $this->write(
                    $this->colorOf($shape)."* ".$this->clearColor()
                );
            }
            $this->writeEmptyLine();
        }
    }
}
