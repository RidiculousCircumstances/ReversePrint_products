<?php

namespace App\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'price', 'a_side', 'b_side', 'sex',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function product_instances(): HasMany
    {
        return $this->hasMany(ProductInstanceModel::class);
    }
}
