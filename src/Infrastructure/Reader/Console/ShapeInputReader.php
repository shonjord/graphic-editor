<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Reader\Console;

use GraphicEditor\Infrastructure\Events\Dispatcher\EventDispatcherInterface;
use GraphicEditor\Infrastructure\Events\EventInterface;
use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use Throwable;

final class ShapeInputReader implements InputReaderInterface
{
    /**
     * @const string
     */
    private const CONTINUE = 'y';

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var array
     */
    private $options;

    /**
     * @var resource|null
     */
    private $stdin;

    /**
     * Amount of shapes
     * @var int|null
     */
    private $count;

    /**
     * @var array|null
     */
    private $input;

    /**
     * @var bool|null
     */
    private $continue;

    public function __construct(EventDispatcherInterface $dispatcher, array $options)
    {
        $this->dispatcher = $dispatcher;
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function read(): array
    {
        $this->initializeContinue();
        $this->initializeStdin();
        $this->initializeCount();
        $this->initializeInput();
        $this->start();

        return $this->input;
    }

    // initializes continue value in case more shapes or not are needed
    private function initializeContinue(): void
    {
        $this->continue = true;
    }

    // initializes the STDIN so the user can give the input
    private function initializeStdin(): void
    {
        $this->stdin = fopen('php://stdin', 'r');
    }

    // initializes the count (amount of shapes) that are added to the input
    private function initializeCount(): void
    {
        $this->count = 0;
    }

    // initializes the input (responsible to store shape input objects)
    private function initializeInput(): void
    {
        $this->input = [];
    }

    // start the process of orchestrating the input creation
    private function start(): void
    {
        while ($this->continue) {
            $this->prepareInput();

            $this->addOneMoreShape() ? $this->startAgain() : $this->exit();
        }
    }

    // asks if one more shape should be added to the collection
    private function addOneMoreShape(): bool
    {
        echo "do you want to add one more shape? [y/n]: ";

        $answer = strtolower($this->getAnswer());

        return static::CONTINUE === $answer;
    }

    // re-start the process of gathering details of the next shape
    private function startAgain(): void
    {
        $this->increaseCount();
        $this->start();
    }

    // increases the amount of shape, this happens when a user answers yes if more shapes should be added
    private function increaseCount(): void
    {
        $this->count = $this->count + 1;
    }

    // changes continue to FALSE to exit the loop
    private function exit(): void
    {
        $this->continue = false;
    }

    // responsible to prepare the shape input that should be added the collection of inputs
    private function prepareInput(): void
    {
        echo "preparing input";
        echo "\n";

        foreach ($this->options as $index => $option) {
            echo sprintf("%s: ", $option);
            $answer = $this->getAnswer();

            $this->isTheFirstIndex($index)
                ? $this->addType($answer)
                : $this->addParam($option, $answer);
        }

        $input = new ShapeInput($this->input[$this->count]);

        $this->addShapeInputToCurrentInput($input);
        $this->dispatch(new ShapeInputWasReceived($input));
    }

    // verifies if the given index is the first one
    private function isTheFirstIndex(int $index): bool
    {
        return 0 === $index;
    }

    // append a new type (shape) to the collection
    private function addType(string $type): void
    {
        $this->input[$this->count]['type'] = $type;
    }

    // append a new param to the collection
    private function addParam(string $param, string $value): void
    {
        $this->input[$this->count]['params'][$param] = $value;
    }

    // appends a shape input object to the collection
    private function addShapeInputToCurrentInput(ShapeInput $input): void
    {
        $this->input[$this->count] = $input;
    }

    // dispatch a message so the listeners can do their work
    private function dispatch(EventInterface $event): void
    {
        try {
            $this->dispatcher->dispatch($event);
        } catch (Throwable $exception) {
            echo sprintf("the shape creation failed due to \n%s", $exception->getMessage());
            echo "\n";
            $this->resetCurrentInput();
            $this->prepareInput();
        }
    }

    // when the shape input creating fails, this should happen
    private function resetCurrentInput(): void
    {
        $this->input[$this->count] = [];
    }

    // returns the answer of the user
    private function getAnswer(): string
    {
        return trim(fgets($this->stdin));
    }
}
