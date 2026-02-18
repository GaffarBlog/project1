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
                        <div class="card-title">Edit User</div>
                    </div>
                </div>
                <div class="card-body p-3 pb-3">
                    <div class="row row-gap-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" value="{{ $user->name }}" class="form-control" id="userName" required name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" value="{{ $user->email }}" class="form-control" id="userEmail" required name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userUsername" class="form-label">Username</label>
                                <input type="text" value="{{ $user->username }}" class="form-control" id="userUsername" required name="username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userPhone" class="form-label">Phone</label>
                                <input type="text" value="{{ $user->phone }}" class="form-control" id="userPhone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userDateOfBirth" class="form-label">Date of Birth</label>
                                <input type="date" value="{{ $user->date_of_birth }}" class="form-control" id="userDateOfBirth" name="date_of_birth">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userGender" class="form-label">Gender</label>
                                <select class="form-control" id="userGender" required name="gender">
                                    <option selected disabled value="">Select Gender</option>
                                    <option @selected($user->gender === 'Male') value="Male">Male</option>
                                    <option @selected($user->gender === 'Female') value="Female">Female</option>
                                    <option @selected($user->gender === 'Third Gender') value="Third Gender">Third Gender</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userCountry" class="form-label">Country</label>
                                <input type="text" value="{{ $user->country }}" class="form-control" id="userCountry" name="country">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userCity" class="form-label">City</label>
                                <input type="text" value="{{ $user->city }}" class="form-control" id="userCity" name="city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userZipCode" class="form-label">Zip Code</label>
                                <input type="text" value="{{ $user->zip }}" class="form-control" id="userZipCode" name="zip">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userType" class="form-label">Type</label>
                                <select class="form-control" id="userType" required name="type">
                                    <option selected disabled value="">Select Type</option>
                                    <option @selected($user->type === 'Admin') value="Admin">Admin</option>
                                    <option @selected($user->type === 'User') value="User">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userAddress" class="form-label">Address</label>
                                <textarea name="address" id="userAddress" class="form-control" rows="5">{{ $user->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userAvatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" id="userAvatar" name="avatar">
                                <img src="{{ asset('assets/img/user2-160x160.jpg') }}" style="width: 100px" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userStatus" class="form-label">Status</label>
                                <select class="form-control" id="userStatus" required name="status">
                                    <option value="">Select Status</option>
                                    <option @selected($user->status === 'Active') value="Active">Active</option>
                                    <option @selected($user->status === 'Inactive') value="Inactive">Inactive</option>
                                    <option @selected($user->status === 'Banned') value="Banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
