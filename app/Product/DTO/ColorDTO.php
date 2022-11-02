<?php

namespace App\Product\DTO;

use Spatie\LaravelData\Data;

class ColorDTO extends Data
{
    public function __construct(
//        public int $id,
        public string $name,
        public string $value
    ) {}


}