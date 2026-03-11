<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'subcategory_id',
        'description',
        'short_description',
        'price',
        'discount',
        'discount_type',
        'discount_start_date',
        'discount_end_date',
        'sku',
        'quantity',
        'low_stock_threshold',
        'status',
        'is_featured',
        'meta_title',
        'meta_description',
        'tags',
        'warranty',
        'is_free_shipping',
        'is_multiple_by_quantity',
        'shipping_cost',
        'estimated_delivery_time',
        'shipping_note',
        'unit_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Hook into the 'creating' event
        static::creating(function ($product) {
            $product->sku = self::generateUniqueSKU($product);
        });
    }

    public static function generateUniqueSKU($product)
    {
        // 1. Get the first 3 letters of the category (Assuming you have a category relationship)
        // If you don't have relationships loaded yet, you might use an abbreviation field from the request
        $categoryPrefix = strtoupper(substr($product->Category->name ?? 'GEN', 0, 3));
        $subcategoryPrefix = strtoupper(substr($product->Subcategory->name ?? 'GEN', 0, 3));

        // 4. Generate a random 4-digit string
        $randomString = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Combine to form the SKU
        $sku = "{$categoryPrefix}-{$subcategoryPrefix}-{$randomString}";

        // 5. Check if this SKU already exists in the database
        if (self::where('sku', $sku)->exists()) {
            // If it exists, call the function recursively to try again
            return self::generateUniqueSKU($product);
        }

        return $sku;
    }

    public function Category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function Subcategory()
    {
        return $this->hasOne(Category::class, 'id', 'subcategory_id');
    }
}
