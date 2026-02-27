@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Role Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.user-role.view"))
                            <a class="btn btn-info text-light btn-sm" href="{{ route("admin.user-role.view") }}">User Roles</a>
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
                        <div class="card-title">Role: {{ $role->name }}</div>
                    </div>
                </div>
                <div class="card-body p-3 pb-3">
                    @php
                        $maxChildren = $routes->max(fn($item) => $item->Childrens->count());
                    @endphp
                    <form action="{{ route("admin.permissions.update") }}" method="POST">
                        @csrf
                        <input name="role_id" type="hidden" value="{{ $role->id }}">
                        <table class="table-bordered table-hover dataTable dtr-inline table" role="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th colspan="{{ $maxChildren - 1 }}">Permission</th>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" id="permission_all" type="checkbox">
                                            <label class="form-check-label" for="permission_all">
                                                Permission All
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $item)
                                    @php $childCount = $item->Childrens->count(); @endphp
                                    <tr>
                                        <th>
                                            {{ ucwords($item->name) }}
                                        </th>

                                        @foreach ($item->Childrens as $child)
                                            <td>
                                                <div class="form-check">
                                                    <input @checked(in_array($child->route, $permissions)) class="form-check-input permissions" id="permission_{{ $child->id }}" name="permissions[]" type="checkbox" value="{{ $child->route }}">
                                                    <label class="form-check-label" for="permission_{{ $child->id }}">
                                                        {{ ucwords($child->name) }}
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach

                                        @if ($maxChildren > $childCount)
                                            <td colspan="{{ $maxChildren - $childCount }}"></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push("js")
    <script src="{{ asset("js/admin/permissions/role-permission.js") }}"></script>
@endpush
