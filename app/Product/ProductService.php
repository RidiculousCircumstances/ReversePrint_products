<?php

namespace App\Product;

use App\Product\DTO\ProductInstanceDTO;
use App\Product\Models\ColorModel;
use App\Product\Models\ProductInstanceModel;
use App\Product\Models\ProductModel;
use App\Product\Models\SizeModel;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(ProductInstanceDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $instance = new ProductInstanceModel();

            $instance->product()->associate(ProductModel::firstWhere('name', '=', $dto->product->name) ??
                ProductModel::create($dto->product->toArray()));

            $instance->size()->associate(SizeModel::firstWhere('value', '=', $dto->size->value) ??
                SizeModel::create($dto->size->toArray()));

            $instance->color()->associate(ColorModel::firstWhere('name', '=', $dto->color->name) ??
                ColorModel::create($dto->color->toArray()));

            $instance->article = $dto->article;
            $instance->stock_balance = $dto->stockBalance;
            $instance->save();

            return $instance->toArray();
        });
    }

    public function getAll(): array
    {
        $instances = ProductInstanceModel::with(['color', 'size', 'product'])->get();

        return $instances->toArray();
    }

    public function getById(string $id)
    {
        return ProductInstanceModel::with(['color', 'size', 'product'])->find($id)->toArray();
    }

    public function delete(string $id)
    {
        $result = ProductInstanceModel::destroy($id);
        if ($result) {
            return ['message' => 'deleted'];
        }

        return ['message' => 'nothing to delete'];
    }
}
