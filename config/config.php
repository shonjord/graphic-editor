<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GraphicEditor\Domain\Shape\Circle\Entity\Circle;
use GraphicEditor\Domain\Triangle\Entity\Triangle;
use GraphicEditor\Infrastructure\Events\Shape\ShapeInputWasReceived;
use GraphicEditor\Infrastructure\Events\Shape\VerifyColorsSubscriber;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapeInputTypesSubscriber;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapeOutputsSubscriber;
use GraphicEditor\Infrastructure\Events\Shape\VerifyShapesSubscriber;
use GraphicEditor\Presentation\Console\StdOut\Shape\Image\CircleImage;
use GraphicEditor\Presentation\Console\StdOut\Shape\Image\TriangleImage;
use GraphicEditor\Presentation\Console\StdOut\Shape\Pattern\CirclePattern;
use GraphicEditor\Presentation\Console\StdOut\Shape\Pattern\TrianglePattern;

// these should ideally be injected through a config file (.yml for example)
$shapes = ['circle' => Circle::class, 'triangle' => Triangle::class];
// more options for the shapes can be added here
$options = ['shape', 'color', 'border', 'size', 'output'];
// more colors can be added here
$colors = ['blue' => "\033[34m", 'yellow' => "\033[43m", 'red' => "\033[31m", 'clear' => "\e[0m"];
// more outputs can be added here
$outputs = ['pattern', 'image'];

// this should ideally be done through an IOC container
$config = (object) [
    'shapes' => $shapes,
    'options' => $options,
    'events' => [
        ShapeInputWasReceived::class => [
            new VerifyShapeInputTypesSubscriber(),
            new VerifyShapeOutputsSubscriber($outputs),
            new VerifyShapesSubscriber($shapes),
            new VerifyColorsSubscriber($colors)
        ]
    ],
    'stdout' => [
        'pattern' => [
            'circle' => new CirclePattern($colors),
            'triangle' => new TrianglePattern($colors)
        ],
        'image' => [
            'circle' => new CircleImage($colors),
            'triangle' => new TriangleImage($colors)
        ]
    ]
];
