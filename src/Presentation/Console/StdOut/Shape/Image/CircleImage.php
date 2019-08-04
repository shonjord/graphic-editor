<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Image;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\Shape\AbstractShapeStdOut;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;

final class CircleImage extends AbstractShapeStdOut implements StdOutInterface
{
    /**
     * This is just an example
     * This logic is coming from: https://www.php.net/manual/en/function.imagefilledellipse.php
     * {@inheritDoc}
     */
    public function display(ShapeInterface $shape): void
    {
        $image = imagecreatetruecolor($shape->getSize()->getValue(), $shape->getBorder()->getValue());
        imagecolorallocate($image, 1, 2, 3);
        $color = imagecolorallocate($image, 255, 255, 255);
        imagefilledellipse($image, 200, 150, 300, 200, $color);

        $this->saveImage($image);
    }

    // stores the generated image into the disc
    private function saveImage($image): void
    {
        ob_start();
        header("Content-type: image/png");
        imagepng($image, "circle.png");
        ob_get_clean();
    }
}
