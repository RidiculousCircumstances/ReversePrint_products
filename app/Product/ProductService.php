<?php

namespace App\Product;


use App\Product\DTO\ColorDTO;
use App\Product\DTO\PicsDTO;
use App\Product\DTO\ProductDTO;
use App\Product\DTO\ProductInstancePartialDTO;
use App\Product\DTO\ProductInstanceUpdateDTO;
use App\Product\DTO\ProductUpdateDTO;
use App\Product\DTO\SizeDTO;
use App\Product\Models\Color;
use App\Product\Models\ProductInstance;
use App\Product\Models\Product;
use App\Product\Models\Size;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Product\DTO\ProductInstanceWholeDTO;
use Spatie\LaravelData\DataCollection;


class ProductService
{

    public function createInstanceWhole (ProductInstanceWholeDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $instance = new ProductInstance();
            $instance->iSaveManyBelongsTo([Product::class => ['name', 'product'],
                    Size::class => ['value', 'size'], Color::class => ['name', 'color']], $dto);
            $instance->article = $dto->article;
            $instance->stock_balance = $dto->stock_balance;
            $instance->save();
            return $instance->toArray();
        });
    }

    public function createInstancePartial (ProductInstancePartialDTO $dto): ProductInstanceWholeDTO
    {
        $model = ProductInstance::create($dto->toArray());
        $withrels = $model->load(['color', 'size', 'product']);
        return ProductInstanceWholeDTO::from($withrels);
    }

    public function createProduct (ProductDTO $dto): ProductDTO
    {
        $model = Product::firstOrCreate(['name' => $dto->name], $dto->toArray());
        return ProductDTO::from($model);
    }

    /**
     * Loads pics and saves paths to them. If pic exists it will be rewritten.
     */
    public function loadPics (PicsDTO $dto): ProductDTO
    {
        $model = Product::firstWhere('id', '=',$dto->id);
        $files = scandir(env('PRODUCT_IMAGES_DIR'));
        foreach ($dto as $key => $value) {
            if (!$value instanceof UploadedFile) {
                continue;
            }
            $path = $value->store('images');
            $erpath =mb_eregi_replace('^[^\/]+/', '',
                $model->$key);
            if (isset($model->$key) && in_array($erpath, $files)) {
                unlink(env('PRODUCT_IMAGES_DIR') . "/$erpath");
            }
            $model->$key = $path;
        }
        $model->save();
        return ProductDTO::from($model);
    }

    public function createColor (ColorDTO $dto): ColorDTO
    {
        return ColorDTO::from(Color::firstOrCreate(['name' => $dto->name], $dto->toArray()));
    }

    public function createSize (SizeDTO $dto): SizeDTO
    {
        return SizeDTO::from(Size::firstOrCreate(['value' => $dto->value], $dto->toArray()));
    }
    
    public function getProducts (): DataCollection
    {
        return ProductDTO::collection(Product::get());
    }

    public function getColors (): DataCollection
    {
        return ColorDTO::collection(Color::get());
    }

    public function getSizes (): DataCollection
    {
        return SizeDTO::collection(Size::get());
    }

    public function getInstances (): DataCollection
    {
        return ProductInstanceWholeDTO::collection((ProductInstance::with(['color', 'size', 'product'])->get()));

    }

    public function getInstance (string $id): array
    {
        return ProductInstance::with(['color', 'size', 'product'])->find($id)->toArray();
    }

    public function updateInstance (ProductInstanceUpdateDTO $dto, string $id): ProductInstanceWholeDTO|null
    {
        $model = ProductInstance::find($id);
        if (is_null($model)) {
            return $model;
        }
        $model->update($dto->toArray());
        $model->load(['color', 'size', 'product']);
        return ProductInstanceWholeDTO::from($model);
    }

    public function updateProduct (ProductUpdateDTO $dto, string $id): ProductDTO|null
    {
        $model = Product::find($id);
        if (is_null($model)) {
            return $model;
        }
        $model->update($dto->toArray());
        return ProductDTO::from($model);

    }

    public function deleteInstance (string $id): bool
    {
        return ProductInstance::destroy($id);
    }

    public function deleteSize (string $id): bool
    {
       return Size::destroy($id);
    }

    public function deleteColor (string $id): bool
    {
        return Color::destroy($id);
    }


    public function deleteProduct (string $id): bool
    {
        return Product::destroy($id);
    }



}
