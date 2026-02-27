@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Users Management</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.users.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.users.view") }}">Users List</a>
                        @endif
                        @if (has_permission("admin.user-role.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.user-role.view") }}">User Role</a>
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
                        <div class="card-title">Edit User</div>
                    </div>
                </div>
                <div class="card-body p-3 pb-3">
                    <form action="{{ route("admin.users.update") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <div class="row row-gap-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userName">Name</label>
                                    <input class="form-control" id="userName" name="name" required type="text" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userEmail">Email</label>
                                    <input class="form-control" id="userEmail" name="email" required type="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userUsername">Username</label>
                                    <input class="form-control" id="userUsername" name="username" required type="text" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userRole">Role</label>
                                    <select class="form-control" id="userRole" name="role_id" required>
                                        <option disabled selected value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option @selected($user->role_id == $role->id) value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userPhone">Phone</label>
                                    <input class="form-control" id="userPhone" name="phone" type="text" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userDateOfBirth">Date of Birth</label>
                                    <input class="form-control" id="userDateOfBirth" name="date_of_birth" type="date" value="{{ $user->date_of_birth }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userGender">Gender</label>
                                    <select class="form-control" id="userGender" name="gender" required>
                                        <option disabled selected value="">Select Gender</option>
                                        <option @selected($user->gender === "Male") value="Male">Male</option>
                                        <option @selected($user->gender === "Female") value="Female">Female</option>
                                        <option @selected($user->gender === "Third Gender") value="Third Gender">Third Gender</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userCountry">Country</label>
                                    <input class="form-control" id="userCountry" name="country" type="text" value="{{ $user->country }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userCity">City</label>
                                    <input class="form-control" id="userCity" name="city" type="text" value="{{ $user->city }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userZipCode">Zip Code</label>
                                    <input class="form-control" id="userZipCode" name="zip" type="text" value="{{ $user->zip }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userAddress">Address</label>
                                    <textarea class="form-control" id="userAddress" name="address" rows="5">{{ $user->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userAvatar">Avatar</label>
                                    <input class="form-control imageInput" data-target="userAvatarPreview" id="userAvatar" name="avatar" type="file">

                                    <img class="img-thumbnail img-preview" id="userAvatarPreview" src="{{ isset($user->images["webp"]) ? $user->images["webp"] : asset("assets/img/user-avatar.png") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="userStatus">Status</label>
                                    <select class="form-control" id="userStatus" name="status" required>
                                        <option value="">Select Status</option>
                                        <option @selected($user->status === "Active") value="Active">Active</option>
                                        <option @selected($user->status === "Inactive") value="Inactive">Inactive</option>
                                        <option @selected($user->status === "Banned") value="Banned">Banned</option>
                                    </select>
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
