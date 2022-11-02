<?php

namespace App\Product;


use App\Product\Models\ColorModel;
use App\Product\Models\ProductInstanceModel;
use App\Product\Models\ProductModel;
use App\Product\Models\SizeModel;
use Illuminate\Support\Facades\DB;
use App\Product\DTO\ProductInstanceDTO;


class ProductService
{

    private function iSaveOneBelongsTo (mixed $model, string $field, mixed $subDTO) {
        return $model::firstWhere($field, '=', $subDTO->$field) ?? $model::create($subDTO->toArray());
    }

    /**
     *
     * Takes children model as "baseModel", which will be linked with other parent models.
     * Parent models are specified in array "models", where key is model name, value:
     * > "$searchColumn" is a column name to be searched to identify
     * the existence of the searched entity;
     * > "$subModelField" is a name of "belongsTo" field of baseModel, also it is name of relevant DTOold's field at the same time.
     *
     * @param mixed $baseModel
     * @param array $models
     * @param mixed $dto
     * @return void
     */
    private function iSaveManyBelongsTo (mixed $baseModel, array $models, mixed $dto): void {
        foreach ($models as $modelName => [$searchColumn, $subModelField]) {

            $baseModel->$subModelField()->associate($modelName::firstWhere($searchColumn, '=', $dto->$subModelField->$searchColumn) ??
                $modelName::create($dto->$subModelField->toArray()));
        }
    }

    public function createProduct(ProductInstanceDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $instance = new ProductInstanceModel();

            $this->iSaveManyBelongsTo($instance, [ProductModel::class => ['name', 'product'],
                    SizeModel::class => ['value', 'size'], ColorModel::class => ['name', 'color']], $dto);

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
            return true;
        }
        return false;
    }

    /*
     * Incorrect
     */
    public function update (ProductInstanceDTO $dto, string $id) {
        $instance = ProductInstanceModel::with(['color', 'size', 'product'])->find($id);

        $this->iSaveManyBelongsTo($instance, [ProductModel::class => ['name', 'product'],
            SizeModel::class => ['value', 'size'], ColorModel::class => ['name', 'color']], $dto);

        $instance->article = $dto->article;
        $instance->stock_balance = $dto->stockBalance;
        $instance->save();



//        return DB::transaction(function () use ($dto, $instance) {
//
//
//
//        });


    }
}
