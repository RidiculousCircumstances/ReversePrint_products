<?php

namespace App\Product\DTO;



use App\Product\Models\Color;
use App\Product\Models\Product;
use App\Product\Models\ProductInstance;
use App\Product\Models\Size;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class ProductInstanceUpdateDTO extends Data
{
    public function __construct (
//        #[Exists(ProductInstance::class, 'id')]
//        public int $id,

        #[Unique(ProductInstance::class, 'article')]
        #[Rule('string|size:9')]
        public string|Optional $article,

        #[Numeric]
        #[GreaterThan(0)]
        public int|Optional $stock_balance,

        #[Numeric]
        #[Exists(Product::class, 'id')]
        public int|Optional $product_id,

        #[Numeric]
        #[Exists(Size::class, 'id')]
        public int|Optional $size_id,

        #[Numeric]
        #[Exists(Color::class, 'id')]
        public int|Optional $color_id

    )
    {}
}