<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($parent_id = null)
    {
        $products = Product::paginate(20);
        $parent_categories = Category::whereNull('parent_id')->orderBy('order')->get();

        return view('admin.products.index', compact('products', 'parent_categories', 'parent_id'));
    }

    // Create product page
    public function create_page()
    {
        $categories = Category::whereNull('parent_id')->select('id', 'name')->get();
        $units = ProductUnit::select('id', 'name', 'abbreviation')->get();

        return view('admin.products.create', compact('categories', 'units'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'unit_id' => 'required|exists:product_units,id',
            'is_featured' => 'nullable',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:fixed,percentage',
            'discount' => 'nullable|numeric|min:0',
            'discount_start_date' => 'nullable|date|required_with:discount',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date|required_with:discount',
            'quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'is_free_shipping' => 'nullable|in:true,false',
            'is_multiple_by_quantity' => 'nullable|in:true,false',
            'shipping_note' => 'required|string|max:1000',
            'shipping_cost' => 'nullable|integer',
            'warranty' => 'nullable|string|max:1000',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            // 'name' => 'required',
        ]);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'unit_id' => $request->unit_id,
            'is_featured' => $request->is_featured ? true : false,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'discount_start_date' => $request->discount_start_date,
            'discount_end_date' => $request->discount_end_date,
            'quantity' => $request->quantity,
            'low_stock_threshold' => $request->low_stock_threshold,
            'is_free_shipping' => $request->is_free_shipping == 'true' ? true : false,
            'is_multiple_by_quantity' => $request->is_multiple_by_quantity == 'true' ? true : false,
            'shipping_cost' => $request->shipping_cost,
            'warranty' => $request->warranty,
            'tags' => $request->tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];
        if ($request->file('banner')) {
            $data['images'] = upload_file($request->file('banner'), 'categories');
        }

        // return $data;
        Product::updateOrCreate($data);

        return back()->with('success', 'Product created successfully.');
    }

    // Get subcategories
    public function subcategories($category_id)
    {
        $subcategories = Category::where('parent_id', $category_id)->select('id', 'name')->get();

        return response()->json(['subcategories' => $subcategories]);
    }

    public function edit($id)
    {
        $categories = Category::whereNull('parent_id')->select('id', 'name')->get();
        $units = ProductUnit::select('id', 'name', 'abbreviation')->get();
        $product = Product::find($id);

        return view('admin.products.edit', compact('categories', 'units', 'product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'sku' => 'nullable|string|max:100|unique:products,sku,'.$id,
            // 'slug' => 'required|string|max:255|unique:products,slug,'.$id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'unit_id' => 'required|exists:product_units,id',
            'is_featured' => 'nullable',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:fixed,percentage',
            'discount' => 'nullable|numeric|min:0',
            'discount_start_date' => 'nullable|date|required_with:discount',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date|required_with:discount',
            'quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'is_free_shipping' => 'nullable|in:true,false',
            'is_multiple_by_quantity' => 'nullable|in:true,false',
            'shipping_note' => 'nullable|string|max:500',
            'shipping_cost' => 'nullable|decimal:0,3',
            'warranty' => 'nullable|string|max:1000',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $product = Product::find($id);
        if (! $product) {
            return back()->with('error', 'Product not found!');
        }
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'unit_id' => $request->unit_id,
            'is_featured' => $request->is_featured ? true : false,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'discount_start_date' => $request->discount_start_date,
            'discount_end_date' => $request->discount_end_date,
            'quantity' => $request->quantity,
            'low_stock_threshold' => $request->low_stock_threshold,
            'is_free_shipping' => $request->is_free_shipping == 'true' ? true : false,
            'is_multiple_by_quantity' => $request->is_multiple_by_quantity == 'true' ? true : false,
            'shipping_note' => $request->shipping_note,
            'shipping_cost' => $request->shipping_cost,
            'shipping_note' => $request->shipping_note,
            'warranty' => $request->warranty,
            'tags' => $request->tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];
        if ($request->file('banner')) {
            $data['images'] = upload_file($request->file('banner'), 'categories');
        }

        $product->update($data);

        return back()->with('success', 'Product updated successfully.');
    }

    // Delete user role
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);
        Product::findOrFail($request->id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
