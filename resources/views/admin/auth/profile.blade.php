@extends("admin.layouts.main")
@section("content")
    <!--begin::App Content Header-->
    <div class="app-content-header">

        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route("admin.dashboard.view") }}">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route("admin.profile.update") }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <label class="d-block text-center">
                                    <img alt="User profile picture" class="img-fluid rounded-circle img-preview" id="userAvatarPreview" src="{{ isset($user->images["webp"]) ? $user->images["webp"] : asset("assets/img/user-avatar.png") }}">
                                    <input class="form-control imageInput" data-target="userAvatarPreview" hidden id="userAvatar" name="avatar" type="file">
                                </label>

                                <h3 class="mt-2 text-center">{{ $user->name }}</h3>

                                <p class="text-muted text-center">{{ $user->Role->name }}</p>

                                {{-- <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a class="btn btn-primary btn-block" href="#"><b>Follow</b></a> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        {{-- <form action="{{ route("admin.profile.update") }}" method="POST">
                            @csrf --}}
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Profile Information</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">

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
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="userRole">Role</label>
                                            <select class="form-control" id="userRole" name="role_id" required>
                                                <option disabled selected value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option @selected($user->role_id == $role->id) value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
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

                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <!--end::Body-->

                        </div>

                        <div class="card card-outline card-primary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                                <div class="card-tools">
                                    <button class="btn btn-tool" data-lte-toggle="card-collapse" type="button">
                                        <i class="bi bi-plus-lg" data-lte-icon="expand"></i>
                                        <i class="bi bi-dash-lg" data-lte-icon="collapse"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">Old Password</label>
                                    <input class="form-control" id="old_password" name="old_password" type="password">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">New Password</label>
                                            <input class="form-control" id="password" name="password" type="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Confirm Password</label>
                                            <input class="form-control" id="confirm_password" name="confirm_password" type="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!--end::App Content-->
@endsection
