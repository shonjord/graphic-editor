<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\Exception;

use Exception;

final class ColorIsNotSupportedException extends Exception
{
    /**
     * @var string
     */
    public $message = 'the following color: %s, is not supported';

    public function __construct(string $value)
    {
        parent::__construct(sprintf($this->message, $value), 0, null);
    }
}
