<?php

namespace App\Product\DTO;

use GuzzleHttp\Psr7\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\LessThan;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Size;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

enum Sex: string
{
    case male = 'male';
    case female = 'female';
    case uni = 'uni';
}

class ProductDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,

        #[Max(500)]
        public string $description,

        #[Numeric, GreaterThan(0)]
        public float  $price,
        public string|null $a_side,
        public string|null $b_side,

        #[Enum(Sex::class)]
        public Sex $sex
    ) {}
}
