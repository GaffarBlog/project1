<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    protected $table = 'product_units';

    protected $fillable = ['name', 'abbreviation'];
}
