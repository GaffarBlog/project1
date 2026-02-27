<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($parent_id = null)
    {
        $categories = Category::orderBy('order')->where(function ($query) use ($parent_id) {
            if ($parent_id) {
                $query->where('parent_id', $parent_id);
            } else {
                $query->whereNull('parent_id');
            }
        })->paginate(20);
        $parent_categories = Category::whereNull('parent_id')->orderBy('order')->get();

        return view('admin.categories.index', compact('categories', 'parent_categories', 'parent_id'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:3000',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ]);
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ];
        if ($request->file('banner')) {
            $data['images'] = upload_file($request->file('banner'), 'categories');
        }

        // return $data;
        Category::updateOrCreate($data);

        return back()->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->orderBy('order')->get();

        return view('admin.categories.edit', compact('category', 'categories'));
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

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete user role
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);
        Category::findOrFail($request->id)->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
