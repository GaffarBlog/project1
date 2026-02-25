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
                    <div class="float-sm-end">
                        <a class="btn btn-info text-light btn-sm" href="{{ route("admin.user-role.index") }}">User Roles</a>
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
                    @foreach ($routes as $item)
                        <div class="card mb-3 p-1">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($item->Childrens as $child)
                                        <div class="col-2">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="permission_{{ $child->id }}" name="permissions[]" type="checkbox" value="{{ $child->id }}">
                                                <label class="form-check-label" for="permission_{{ $child->id }}">{{ ucwords($child->name) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push("js")
    <script src="{{ asset("js/admin/permissions/role-permission.js") }}"></script>
@endpush
