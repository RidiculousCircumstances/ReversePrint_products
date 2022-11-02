<?php

namespace App\Product\DTO;


use App\Product\Models\ProductInstanceModel;
use App\Product\Models\ProductModel;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Numeric;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Size;

use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;



class ProductInstanceDTO extends Data
{
    public function __construct(
//        public ?int $id,

        public ColorDTO|Optional $color,

        public SizeDTO|Optional $size,

        public ProductDTO|Optional $product,

        #[Unique(ProductInstanceModel::class, 'article')]
        #[Rule('string|size:9')]
        public string|Optional $article,

        #[Numeric]
        #[GreaterThan(0)]
        public int|Optional $stockBalance
    )
    {}


}