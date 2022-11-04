<?php

namespace App\Product\DTO;


use App\Product\Models\ProductInstance;
use Illuminate\Http\Request;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;




class ProductInstanceWholeDTO extends Data
{
    public function __construct(
        public ?int $id,

        #[Unique(ProductInstance::class, 'article')]
        #[Rule('string|size:9')]
        public string $article,

        #[Numeric]
        #[GreaterThan(0)]
        public int $stock_balance,

        public ?string $created_at,

        public ?string $updated_at,

        public ?ColorDTO $color,

        public ?SizeDTO $size,

        public ?ProductDTO $product,

    ) {}



    /**
     * @param Request $req
     * @param Data $DTO
     * @return Data
     */
    public static function formData(Request $req): self {
        $plain = $req->data;
        $json = json_decode($plain);
        foreach ($json as $key => $value) {
            if(gettype($value) === "object") {
                foreach ($value as $nestedkey => $nestedvalue) {
                    $req[$key] = $req[$key] ? $req[$key] + [$nestedkey => $nestedvalue] : [$nestedkey => $nestedvalue];
                }
            } else {
                $req[$key] = $value;
            }
        }
        return self::from($req);
    }

}