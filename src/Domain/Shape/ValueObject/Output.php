<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\ValueObject;

final class Output
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    // returns a string representation of $this output
    public function __toString(): string
    {
        return $this->value;
    }
}
