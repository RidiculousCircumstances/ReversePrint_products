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

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'colorName' => 'nullable|string',
            'colorValue' => 'nullable|string|starts_with:#',
            'size' => 'nullable|string',
            'productName' => 'nullable|string',
            'productDescription' => 'nullable|string|nullable|max:500',
            'productPrice' => 'nullable|numeric',
            'productPathASide' => 'nullable|string',
            'productPathBSide' => 'nullable|string',
            'productArticle' => 'nullable|string|unique:App\Product\Models\ProductInstanceModel,article|size:9',
            'productStockBalance' => 'nullable|numeric',
            'sex' => [new Enum(Sex::class)],
        ];
    }
}
