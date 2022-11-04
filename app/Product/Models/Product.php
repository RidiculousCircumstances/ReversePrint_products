<?php

namespace App\Product\Models;

use App\Common\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 * @param
 */
class Product extends BaseModel
{

    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'price', 'a_side', 'b_side', 'sex',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function product_instances(): HasMany
    {
        return $this->hasMany(ProductInstance::class);
    }
}
