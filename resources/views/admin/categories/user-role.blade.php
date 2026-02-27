@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Role Management</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.users.index"))
                            <a class="btn btn-info text-light btn-sm" href="{{ route("admin.users.index") }}">Users</a>
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
                        <div class="card-title">User Roles List: {{ $roles->count() }}</div>
                        @if (has_permission("admin.user-role.create"))
                            <button class="btn btn-primary btn-sm create-btn"><i class="bi bi-plus-lg"></i> Create</button>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0 pb-3">
                    <table class="table-bordered table-hover dataTable dtr-inline table" role="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15px">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        {{ $item->description ?? "No description" }}
                                    </td>
                                    <td>

                                        <div class="btn-group btn-group-sm me-2">
                                            @if (has_permission("admin.user-role.edit"))
                                                <button class="btn btn-primary edit_btn" data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                            @endif
                                            @if (has_permission("admin.user-role.delete"))
                                                <button class="btn btn-danger delete_btn" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                            @endif
                                        </div>
                                        @if (has_permission("admin.permissions.index"))
                                            <a class="btn btn-info btn-sm inline-block text-white" href="{{ route("admin.permissions.index", ["role_id" => $item->id]) }}"><i class="bi bi-lock"></i> Permissions</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--------Edit Modal---------->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User Role</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.user-role.update") }}" method="POST">
                    @csrf
                    <input id="editId" name="id" type="hidden">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="editUserRole">Role</label>
                            <input class="form-control" id="editUserRole" name="name" type="text">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="editUserDescription">Description</label>
                            <input class="form-control" id="editUserDescription" name="description" type="text">
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
                    <h5 class="modal-title">Delete User Role</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.user-role.delete") }}" method="POST">
                    @csrf
                    <input id="deleteId" name="id" type="hidden">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user role?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--------Create Modal---------->
    <div class="modal" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User Role</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route("admin.user-role.create") }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="userRole">Role</label>
                            <input class="form-control" id="userRole" name="name" required type="text">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="userDescription">Description</label>
                            <input class="form-control" id="userDescription" name="description" type="text">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script src="{{ asset("js/admin/user-role.js") }}"></script>
@endpush
