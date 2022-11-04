<?php

namespace App\Product\DTO;

use Spatie\LaravelData\Data;

class SizeDTO extends Data
{


    public function __construct(
        public ?int $id,
        public string $value
    ) {}
}