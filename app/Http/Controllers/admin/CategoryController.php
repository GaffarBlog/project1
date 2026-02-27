<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function post_create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string|max:3000',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ]);
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
        ];
        if ($request->file('avatar')) {
            $data['images'] = upload_file($request->file('avatar'), 'categories');
        }
        Category::updateOrCreate($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category', 'roles'));
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
        if ($request->file('avatar')) {
            $images = upload_file($request->file('avatar'), 'categories');
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
