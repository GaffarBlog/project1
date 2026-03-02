<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    public function index($attr = null)
    {
        return view('admin.attributes.index', compact('attr'));
    }
}
