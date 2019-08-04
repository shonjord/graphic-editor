<?php declare(strict_types=1);

namespace GraphicEditor\Domain\Shape\Factory;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Domain\Shape\ValueObject\Border;
use GraphicEditor\Domain\Shape\ValueObject\Color;
use GraphicEditor\Domain\Shape\ValueObject\Output;
use GraphicEditor\Domain\Shape\ValueObject\Size;
use GraphicEditor\Infrastructure\Reader\Console\InputInterface;
use GraphicEditor\Infrastructure\Reader\Console\ShapeInput;

final class ShapeFactory implements ShapeFactoryInterface
{
    /**
     * @var array
     */
    private $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    /**
     * @param InputInterface|ShapeInput $input
     * @return ShapeInterface
     */
    public function buildFromInput(InputInterface $input): ShapeInterface
    {
        $shape = $this->retrieveInputShape($input);

        return new $shape(
            new Color($input->getColorValue()),
            new Size($input->getSizeValue()),
            new Border($input->getBorderValue()),
            new Output($input->getOutputValue())
        );
    }

    // retrieves the correspondent shape class from the input
    private function retrieveInputShape(ShapeInput $input): string
    {
        return $this->shapes[$input->getType()];
    }
}
