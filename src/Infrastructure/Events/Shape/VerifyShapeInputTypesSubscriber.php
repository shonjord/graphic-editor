<?php declare(strict_types=1);

namespace GraphicEditor\Infrastructure\Events\Shape;

use GraphicEditor\Infrastructure\Events\AbstractListener;
use InvalidArgumentException;

final class VerifyShapeInputTypesSubscriber extends AbstractListener
{
    /**
     * @var array|null
     */
    private $errors;

    // verifies the integrity of the input
    public function onShapeInputWasReceived(ShapeInputWasReceived $event): void
    {
        $input = $event->getInput()->getRawInput();
        $border = $input['params']['border'];
        $size = $input['params']['size'];

        if (!is_numeric($border)) {
            $this->addError(sprintf(
                'Border should be a valid numeric value, value given: %s',
                $border
            ));
        }

        if (!is_numeric($size)) {
            $this->addError(sprintf(
                'Size should be a valid numeric value, value given: %s',
                $size
            ));
        }

        if ($this->hasErrors()) {
            throw new InvalidArgumentException(
                implode(",\n", $this->errors)
            );
        }
    }

    // append errors to the collection
    private function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    // verifies if there were errors during the process
    private function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
