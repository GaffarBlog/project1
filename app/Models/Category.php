<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'order',
        'status',
        'parent_id',
    ];

    protected $casts = [
        'images' => 'json',
    ];

    public function Parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
