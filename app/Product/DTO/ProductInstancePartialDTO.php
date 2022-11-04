<?php

namespace App\Product\DTO;



use App\Product\Models\Color;
use App\Product\Models\Product;
use App\Product\Models\ProductInstance;
use App\Product\Models\Size;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class ProductInstancePartialDTO extends Data
{
    public function __construct (
        public ?int $id,

        #[Unique(ProductInstance::class, 'article')]
        #[Rule('string|size:9')]
        public string $article,

        #[Numeric]
        #[GreaterThan(0)]
        public int $stock_balance,

        public ?string $created_at,

        public ?string $updated_at,

        #[Numeric]
        #[Exists(Product::class, 'id')]
        public int $product_id,

        #[Numeric]
        #[Exists(Size::class, 'id')]
        public int $size_id,

        #[Numeric]
        #[Exists(Color::class, 'id')]
        public int $color_id

    )
    {}
}