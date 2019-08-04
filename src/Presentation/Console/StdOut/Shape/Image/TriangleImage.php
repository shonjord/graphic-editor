<?php declare(strict_types=1);

namespace GraphicEditor\Presentation\Console\StdOut\Shape\Image;

use GraphicEditor\Domain\Shape\ShapeInterface;
use GraphicEditor\Presentation\Console\StdOut\Shape\AbstractShapeStdOut;
use GraphicEditor\Presentation\Console\StdOut\StdOutInterface;

final class TriangleImage extends AbstractShapeStdOut implements StdOutInterface
{
    /**
     * This is just an example
     * This logic is coming from: https://www.php.net/manual/en/function.imagefilledpolygon.php
     * {@inheritDoc}
     */
    public function display(ShapeInterface $shape): void
    {
        $values = [
            40,  50,  // Point 1 (x, y)
            20,  240, // Point 2 (x, y)
            60,  60,  // Point 3 (x, y)
            240, 20,  // Point 4 (x, y)
            50,  40,  // Point 5 (x, y)
            10,  10   // Point 6 (x, y)
        ];

        // create image
        $image = imagecreatetruecolor(
            $shape->getSize()->getValue(),
            $shape->getBorder()->getValue()
        );

        // allocate colors
        $bg   = imagecolorallocate($image, 0, 0, 0);
        $blue = imagecolorallocate($image, 0, 0, 255);

        // fill the background
        imagefilledrectangle($image, 0, 0, 249, 249, $bg);

        // draw a polygon
        imagefilledpolygon($image, $values, 6, $blue);

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
