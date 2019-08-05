<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Pattern;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\Shape\AbstractShapeStdOut;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;

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
                $this->changeDistance(sqrt(
                    ($i - $radius) * ($i - $radius) + ($j - $radius) * ($j - $radius)
                ));

                if ($this->distanceIsHigherThan($radius - 0.5) && $this->distanceIsLowerThan($radius + 0.5)) {
                    $this->write($this->colorOf($shape)."*".$this->clearColor());
                } else {
                    $this->write(" ");
                }
            }
            $this->writeEmptyLine();
        }
    }

    // changes the distance of the circle
    private function changeDistance(float $value): void
    {
        $this->distance = $value;
    }

    // verifies if the given value is higher than the current distance
    private function distanceIsHigherThan(float $value): bool
    {
        return $this->distance > $value;
    }

    // verifies if the given value is lower than the current distance
    private function distanceIsLowerThan(float $value): bool
    {
        return $this->distance < $value;
    }
}
