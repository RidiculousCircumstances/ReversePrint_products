<?php

namespace App\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $article
 * @property string $stock_balance
 * @mixin Builder
 */
class ProductInstanceModel extends Model
{
    use HasFactory;

    protected $table = 'product_instances';

    protected $hidden = [
        'color_id',
        'size_id',
        'product_id',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(ColorModel::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(SizeModel::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }
}
