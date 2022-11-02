<?php

namespace App\Product\DTO;

use Spatie\LaravelData\Attributes\Validation\Enum;
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
//        public int $id,
        public string|Optional $name,
        public string|Optional $description,
        public float|Optional  $price,
        public string|Optional $path_to_a_side,
        public string|Optional $path_to_b_side,
        #[Enum(Sex::class)]
        public Sex|Optional $sex
    ) {}
}