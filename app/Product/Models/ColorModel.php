<?php

namespace App\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class ColorModel extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = [
        'name', 'value',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function product_instances(): HasMany
    {
        return $this->hasMany(ProductInstanceModel::class);
    }
}
