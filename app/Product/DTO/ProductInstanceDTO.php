<?php

namespace App\Product\DTO;

use Spatie\LaravelData\Data;

class ProductInstanceDTO extends Data
{

    public function __construct(
//        public int $id,
        public ColorDTO $color,
        public SizeDTO $size,
        public ProductDTO $product,
        public int $article,
        public int $stockBalance
    )
    {}


}