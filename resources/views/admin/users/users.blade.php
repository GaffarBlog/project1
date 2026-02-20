@extends('admin.layouts.main')
@section('content')
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Users Management</h3>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-end">
                        <div class="float-sm-end">
                            <a href="{{ route('admin.user-role.index') }}" class="btn btn-info btn-sm text-light">User Role</a>
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
                        <div class="card-title">Users: {{ $users->total() }}</div>
                        <button class="btn btn-primary btn-sm create-btn"><i class="bi bi-plus-lg"></i> Create</button>
                    </div>
                </div>
                <div class="card-body p-0 pb-3">
                    <table class="table table-bordered table-hover dataTable dtr-inline" role="table">
                        <thead>
                            <tr>
                                <th style="width: 15px" scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Status</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr class="align-middle">
                                    <td>{{ $users->perPage() * ($users->currentPage() - 1) + $loop->iteration }}</td>
                                    <td style="width: 50px">
                                        @if (isset($item->images['webp']))
                                            <img src="{{ $item->images['webp'] }}" class="img-thumbnail" alt="">
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('assets/img/user-avatar.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>
                                        @if ($item->status === 'Active')
                                            <span class="badge text-bg-success">Active</span>
                                        @elseif($item->status === 'Inactive')
                                            <span class="badge text-bg-warning">Inactive</span>
                                        @else
                                            <span class="badge text-bg-danger">Banned</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                            <button class="btn btn-danger delete_btn" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                    <div class="mt-3 px-2">
                        {{ $users->links() }}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" required name="name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" required name="email">
                        </div>
                        <div class="form-group mt-3">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPassword" required name="password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="userConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="userConfirmPassword" required name="password_confirmation">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('js/admin/users.js') }}"></script>
@endpush
