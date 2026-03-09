<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';

    protected $fillable = [
        'name',
        'shipping_by',
        'category_id',
        'subcategory_id',
        'cost',
        'is_multiple_by_quantity',
        'estimated_delivery_time',
        'description',
    ];
}
