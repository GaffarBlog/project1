<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Shipping;
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
        $shippings = Shipping::select('id', 'name')->where('shipping_by', 'product')->get();

        return view('admin.products.create', compact('categories', 'units', 'shippings'));
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
            'is_free_shipping' => 'nullable|boolean',
            'shipping_id' => 'nullable|required_if:is_free_shipping,0|exists:shippings,id',
            'is_warranty' => 'nullable|boolean',
            'warranty_id' => 'nullable|required_if:is_warranty,1|exists:warranties,id',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
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
            'is_free_shipping' => $request->is_free_shipping,
            'shipping_id' => $request->shipping_id,
            'is_warranty' => $request->is_warranty,
            'warranty_id' => $request->warranty_id,
            // 'status' => $request->status,
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
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->orderBy('order')->get();

        return view('admin.products.edit', compact('category', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$request->id,
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string|max:3000',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ]);
        $category = Category::findOrFail($request->id);
        $images = $category->images;
        if ($request->file('banner')) {
            $images = upload_file($request->file('banner'), 'categories');
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'images' => $images,
        ]);

        return redirect()->route('admin.products.view', ['parent_id' => $category->parent_id ?? null])->with('success', 'Category updated successfully.');
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
