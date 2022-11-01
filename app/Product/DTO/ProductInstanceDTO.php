<?php

namespace App\Product\DTO;

use App\Product\Models\ProductModel;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class ProductInstanceDTO extends DataTransferObject
{
    public ?int $id;

    public ColorDTO $color;

    public SizeDTO $size;

    public ProductDTO $product;

    public int $article;

    public int $stockBalance;

    public static function fromRequest(Request $req): self
    {
        return new self(
            color: [
                'name' => $req['colorName'],
                'value' => $req['colorValue'],
            ],
            size: [
                'value' => $req['size'],
            ],
            product: [
                'name' => $req['productName'],
                'description' => $req['productDescription'],
                'price' => $req['productPrice'],
                'path_to_a_side' => $req['productPathASide'],
                'path_to_b_side' => $req['productPathBSide'],
                'sex' => $req['sex'],
            ],
            article: $req['productArticle'],
            stockBalance: $req['productStockBalance']
        );
    }

//    public static function fromModel(ProductModel $model): self {
//        return new self(
//            color: [
//                'id' => $model->color->id
//            ]
//        );
//    }
}
