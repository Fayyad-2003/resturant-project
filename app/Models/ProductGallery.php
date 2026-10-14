<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGallery extends Model
{
    protected $fillable = [
        'product_id',
        'src'
    ];

    /**
     * Get the product that owns the gallery image.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
