<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Reader\Console;

interface InputInterface
{
    // returns the raw input value
    public function getRawInput(): array;
}
