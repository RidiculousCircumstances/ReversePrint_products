<?php

namespace App\Common\Models;

trait Saver
{
    /**
     *
     * Takes children model as "baseModel", which will be linked with other parent models.
     * Parent models are specified in array "models", where key is model name, value:
     * > "$searchColumn" is a column name to be searched to identify
     * the existence of the searched entity;
     * > "$subModelField" is a name of "belongsTo" field of baseModel, also it is name of relevant DTOold's field at the same time.
     *
     *
     */
//    public static function iSaveManyBelongsTo (mixed $baseModel, array $models, mixed $dto): void {
//        foreach ($models as $modelName => [$searchColumn, $subModelField]) {
//
//            $baseModel->$subModelField()->associate($modelName::firstWhere($searchColumn, '=', $dto->$subModelField->$searchColumn) ??
//                $modelName::create($dto->$subModelField->toArray()));
//        }
//    }


    public function iSaveManyBelongsTo (array $models, mixed $dto): void {
        foreach ($models as $modelName => [$searchColumn, $subModelField]) {

            $this->$subModelField()->associate($modelName::firstWhere($searchColumn, '=', $dto->$subModelField->$searchColumn) ??
                $modelName::create($dto->$subModelField->toArray()));
        }
    }


    public static function iSave (string $searchedColumn, mixed $dto) {
        return static::firstWhere($searchedColumn, '=', $dto->$searchedColumn) ?? static::create($dto->toArray());
    }
}