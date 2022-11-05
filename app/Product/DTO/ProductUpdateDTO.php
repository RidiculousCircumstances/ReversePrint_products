<?php

namespace App\Product\DTO;


use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;


class ProductUpdateDTO extends Data
{
    public function __construct(

        public string|Optional $name,

        #[Max(500)]
        public string|Optional $description,

        #[Numeric, GreaterThan(0)]
        public float|Optional  $price,

        public string|null|Optional $a_side,
        public string|null|Optional $b_side,

        #[Enum(Sex::class)]
        public Sex|Optional $sex
    ) {}
}
