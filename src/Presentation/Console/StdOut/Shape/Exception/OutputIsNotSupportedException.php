<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Exception;

use InvalidArgumentException;

final class OutputIsNotSupportedException extends InvalidArgumentException
{
    /**
     * @var string
     */
    public $message = 'the following output: %s, is not supported';

    public function __construct(string $value)
    {
        parent::__construct(sprintf($this->message, $value), 0, null);
    }
}
