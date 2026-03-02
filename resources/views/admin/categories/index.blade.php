@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Categories Management</h3>
                </div>
                <div class="col-sm-6">
                    @if (has_permission("admin.products.view"))
                        <div class="text-end">
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.products.view") }}">Products</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--------Page Content---------->
    <section class="content">
        <div class="container-fluid">
            @if (has_permission("admin.categories.create"))
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="card-title">Create Category</div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-3">
                        <form action="{{ route("admin.categories.create") }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input name="parent_id" type="hidden" value="{{ $parent_id }}">
                            <div class="row row-gap-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="categoryName">Category Name</label>
                                        <input class="form-control" id="categoryName" name="name" required type="text" value="{{ old("name") }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="categoryBanner">Category Banner</label>
                                        <input class="form-control" id="categoryBanner" name="banner" type="file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="categoryDescription">Description</label>
                                        <textarea class="form-control" id="categoryDescription" name="description" rows="5">{{ old("description") }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-3 text-end">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">
                            @if ($parent_id)
                                Subcategory of : {{ $parent_categories->where("id", $parent_id)->first()->name ?? "--" }} ({{ $categories->total() }})
                            @else
                                Categories: {{ $categories->total() }}
                            @endif
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{ route("admin.categories.view") }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 pb-3">
                    <table class="table-bordered table-hover dataTable dtr-inline table" role="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15px">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="align-middle">
                                    <td>{{ $categories->perPage() * ($categories->currentPage() - 1) + $loop->iteration }}</td>

                                    <td>
                                        @if ($item->parent_id)
                                            {{ $item->name }}
                                        @else
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route("admin.categories.view", ["parent_id" => $item->id]) }}">{{ $item->name }}</a>
                                                <span class="badge text-bg-info text-white">{{ $item->subcategories_count ?? 0 }}</span>
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status === "Active")
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (has_permission("admin.categories.edit"))
                                                <a class="btn btn-primary" href="{{ route("admin.categories.edit", $item->id) }}"><i class="bi bi-pencil-square"></i></a>
                                            @endif
                                            @if (has_permission("admin.categories.delete"))
                                                <button class="btn btn-danger delete_btn" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="mt-3 px-2">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="home" aria-selected="true" class="nav-link active" data-bs-target="#home" data-bs-toggle="tab" id="home-tab" role="tab" type="button">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="profile" aria-selected="false" class="nav-link" data-bs-target="#profile" data-bs-toggle="tab" id="profile-tab" role="tab" type="button">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="contact" aria-selected="false" class="nav-link" data-bs-target="#contact" data-bs-toggle="tab" id="contact-tab" role="tab" type="button">Contact</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="home-tab" class="tab-pane fade show active" id="home" role="tabpanel">...</div>
                    <div aria-labelledby="profile-tab" class="tab-pane fade" id="profile" role="tabpanel">...</div>
                    <div aria-labelledby="contact-tab" class="tab-pane fade" id="contact" role="tabpanel">...</div>
                </div>
            </div>
        </div>
    </section>

    <!--------Delete Modal---------->
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.categories.delete") }}" method="POST">
                    @csrf
                    <input id="deleteId" name="id" type="hidden">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this category?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
