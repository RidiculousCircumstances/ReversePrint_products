<?php

namespace App\Product\Models;

use App\Common\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property string $article
 * @property string $stock_balance
 * @mixin Builder
 */
class ProductInstance extends BaseModel
{
    protected $table = 'product_instances';

    protected $hidden = [
        'color_id',
        'size_id',
        'product_id',
    ];

    protected $fillable =[
        'article',
        'stock_balance',
        'color_id',
        'size_id',
        'product_id',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
