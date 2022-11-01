<?php

namespace App\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

enum Sex: string
{
    case male = 'male';
    case female = 'female';
    case uni = 'uni';
}

class ProductCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'colorName' => 'required',
            'colorValue' => 'required|starts_with:#',
            'size' => 'required',
            'productName' => 'required',
            'productDescription' => 'string|nullable|max:500',
            'productPrice' => 'required|numeric',
            'productPathASide' => 'string|nullable',
            'productPathBSide' => 'string|nullable',
            'productArticle' => 'required|string|unique:App\Product\Models\ProductInstanceModel,article|size:9',
            'productStockBalance' => 'numeric',
            'sex' => [new Enum(Sex::class)],
        ];
    }
}
