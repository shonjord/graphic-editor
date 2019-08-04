<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console;

// interface to be implemented by any CLI application
interface ConsoleInterface
{
    // runs a CLI application
    public function run(): void;
}
