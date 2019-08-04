<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Triangle\Entity;

use GraphicEditor\Domain\Shape\AbstractShape;

final class Triangle extends AbstractShape
{
    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return 'triangle';
    }
}
