<?php

namespace App\Product\DTO;

use Spatie\LaravelData\Data;

class ProductDTO extends Data
{


    public function __construct(
//        public int $id,
        public string $name,
        public string $description,
        public float  $price,
        public string $path_to_a_side,
        public string $path_to_b_side,
        public string $sex
    ) {}
}