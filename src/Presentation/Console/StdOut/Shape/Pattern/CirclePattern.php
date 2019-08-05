<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Pattern;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;
use GraphicEditor\Presentation\Console\StdOut\Shape\AbstractShapeStdOut;

final class CirclePattern extends AbstractShapeStdOut implements StdOutInterface
{
    /**
     * @var float
     */
    private $distance;

    /**
     * {@inheritDoc}
     */
    public function display(ShapeInterface $shape): void
    {
        $radius = $shape->getSize()->getValue();

        for ($i = 0; $i <= 2 * $radius; $i++) {
            for ($j = 0; $j <= 2 * $radius; $j++) {
                $this->distance = sqrt(($i - $radius) *
                    ($i - $radius) +
                    ($j - $radius) *
                    ($j - $radius));

                if ($this->distance > $radius - 0.5 && $this->distance < $radius + 0.5) {
                    $this->write($this->colorOf($shape)."*".$this->clearColor());
                } else {
                    $this->write(" ");
                }
            }
            $this->writeEmptyLine();
        }
    }
}
