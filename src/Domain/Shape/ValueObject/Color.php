<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\ValueObject;

final class Color
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    // returns a string representation of $this color
    public function __toString(): string
    {
        return $this->value;
    }
}
