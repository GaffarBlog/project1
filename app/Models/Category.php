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

    public function Parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
