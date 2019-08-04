<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\ValueObject;

final class Size
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    // returns the value of $this size
    public function getValue(): int
    {
        return $this->value;
    }
}
