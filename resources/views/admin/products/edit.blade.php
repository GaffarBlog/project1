@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Category</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.categories.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.categories.view") }}">Categories List</a>
                        @endif
                        @if (has_permission("admin.products.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.products.view") }}">Products</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------Page Content---------->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Edit Category</div>
                    </div>
                </div>
                <div class="card-body p-3 pb-3">
                    <form action="{{ route("admin.categories.update") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{ $category->id }}">
                        <div class="row row-gap-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="categoryName">Category Name</label>
                                    <input class="form-control" id="categoryName" name="name" required type="text" value="{{ old("name", $category->name) }}">
                                </div>
                            </div>
                            @if ($category->parent_id)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="parentCategory">Parent Category</label>
                                        <select class="form-control" id="parentCategory" name="parent_id">
                                            <option value="">Select Parent Category</option>
                                            @foreach ($categories as $cat)
                                                <option @selected($category->parent_id === $cat->id) value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userStatus">Status</label>
                                    <select class="form-control" id="userStatus" name="status" required>
                                        <option value="">Select Status</option>
                                        <option @selected($category->status === "Active") value="Active">Active</option>
                                        <option @selected($category->status === "Inactive") value="Inactive">Inactive</option>
                                        <option @selected($category->status === "Banned") value="Banned">Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="categoryBanner">Category Banner</label>
                                    <input class="form-control imageInput" data-target="categoryBannerPreview" id="categoryBanner" name="banner" type="file">

                                    <img class="img-thumbnail img-preview" id="categoryBannerPreview" src="{{ isset($category->images["webp"]) ? $category->images["webp"] : asset("assets/img/user-avatar.png") }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="categoryDescription">Description</label>
                                    <textarea class="form-control" id="categoryDescription" name="description" rows="5">{{ old("description", $category->description) }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
