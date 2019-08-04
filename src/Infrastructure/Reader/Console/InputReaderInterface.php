<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Reader\Console;

use Throwable;

interface InputReaderInterface
{
    /**
     * Reads the input from a CLI app
     *
     * @return array
     * @throws Throwable
     */
    public function read(): array;
}
