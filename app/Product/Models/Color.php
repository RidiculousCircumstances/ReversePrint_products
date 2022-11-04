<?php

namespace App\Product\Models;

use App\Common\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Color extends BaseModel
{

    protected $table = 'colors';

    protected $fillable = [
        'name', 'value',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function product_instances(): HasMany
    {
        return $this->hasMany(ProductInstance::class);
    }
}
