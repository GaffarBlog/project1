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
                    <div class="float-sm-end">
                        <div class="float-sm-end">
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.products.index") }}">Products</a>
                        </div>
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
                        <div class="card-title">Categories: {{ $categories->total() }}</div>
                        <div>
                            @if (has_permission("admin.categories.createPage"))
                                <a class="btn btn-primary btn-sm" href="{{ route("admin.categories.createPage") }}"><i class="bi bi-plus-lg"></i> Create</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body p-0 pb-3">
                    <table class="table-bordered table-hover dataTable dtr-inline table" role="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15px">#</th>
                                <th scope="col">Thumb</th>
                                <th scope="col">Name</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="align-middle">
                                    <td>{{ $categories->perPage() * ($categories->currentPage() - 1) + $loop->iteration }}</td>
                                    <td style="width: 50px">
                                        @if (isset($item->images["webp"]))
                                            <img alt="" class="img-thumbnail" src="{{ $item->images["webp"] }}">
                                        @else
                                            <img alt="" class="img-thumbnail" src="{{ asset("assets/img/user-avatar.png") }}">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->Parent?->name ?? "None" }}</td>

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
        </div>
    </section>

    <!--------Create Modal---------->
    <div class="modal" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.users.create") }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="userName">Name</label>
                            <input class="form-control" id="userName" name="name" required type="text">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="userEmail">Email</label>
                            <input class="form-control" id="userEmail" name="email" required type="email">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="userPassword">Password</label>
                            <input class="form-control" id="userPassword" name="password" required type="password">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="userConfirmPassword">Confirm Password</label>
                            <input class="form-control" id="userConfirmPassword" name="password_confirmation" required type="password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--------Delete Modal---------->
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.users.delete") }}" method="POST">
                    @csrf
                    <input id="deleteId" name="id" type="hidden">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
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

@push("js")
    <script src="{{ asset("js/admin/users.js") }}"></script>
@endpush
