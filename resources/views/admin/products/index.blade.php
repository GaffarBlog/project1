@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Products Management</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.categories.view"))
                            <a class="btn btn-info btn-sm text-light me-2" href="{{ route("admin.categories.view") }}">Categories</a>
                        @endif
                        @if (has_permission("admin.attributes.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.attributes.view") }}">Attributes</a>
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
                        <div class="card-title">
                            Products: {{ $products->total() }}
                        </div>
                        <div>
                            @if (has_permission("admin.products.createPage"))
                                <a class="btn btn-primary" href="{{ route("admin.products.createPage") }}">Create</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-x-auto p-0 pb-3">
                    <table class="table-bordered table-hover dataTable dtr-inline table" role="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15px">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Subcategory</th>
                                <th scope="col">Price</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Featured</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr class="align-middle">
                                    <td>{{ $products->perPage() * ($products->currentPage() - 1) + $loop->iteration }}</td>

                                    <td>
                                        {{ $item->title }}
                                    </td>

                                    <td>{{ $item->Category?->name }}</td>
                                    <td>{{ $item->Subcategory?->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->is_featured }}</td>
                                    <td>
                                        @if ($item->status === "Active")
                                            <span class="badge text-bg-success">Active</span>
                                        @elseif($item->status === "Inactive")
                                            <span class="badge text-bg-warning">Inactive</span>
                                        @else
                                            <span class="badge text-bg-danger">Banned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (has_permission("admin.categories.edit"))
                                                <a class="btn btn-primary" href="{{ route("admin.products.edit", $item->id) }}"><i class="bi bi-pencil-square"></i></a>
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
                        {{ $products->links() }}
                    </div>
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
                <form action="{{ route("admin.products.delete") }}" method="POST">
                    @csrf
                    <input id="deleteId" name="id" type="hidden">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this product?</p>
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
