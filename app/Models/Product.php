<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'main_image',
        'category_id',
        'short_description',
        'long_description',
        'price',
        'offer_price',
        'sku',
        'seo_title',
        'seo_description',
        'show_at_home',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'offer_price' => 'decimal:2',
        'show_at_home' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes(): HasMany {
        return $this->hasMany(ProductSize::class);
    }
    
    public function options(): HasMany {
        return $this->hasMany(ProductOption::class);
    }

    public function wishlists(): MorphMany
    {
        return $this->morphMany(Wishlist::class, 'model');
    }
}
