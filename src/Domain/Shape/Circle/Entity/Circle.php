<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\Circle\Entity;

use GraphicEditor\Domain\Shape\AbstractShape;

final class Circle extends AbstractShape
{
    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return 'circle';
    }
}
