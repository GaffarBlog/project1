<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link" href="#">Contact</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img alt="User Avatar" class="img-size-50 rounded-circle me-3" src="{{ asset("assets/img/user1-128x128.jpg") }}" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="fs-7 text-danger float-end"><i class="bi bi-star-fill"></i></span>
                                </h3>
                                <p class="fs-7">Call me whenever you can...</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img alt="User Avatar" class="img-size-50 rounded-circle me-3" src="{{ asset("assets/img/user8-128x128.jpg") }}" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="fs-7 text-secondary float-end">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">I got your message bro</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img alt="User Avatar" class="img-size-50 rounded-circle me-3" src="{{ asset("assets/img/user3-128x128.jpg") }}" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="fs-7 text-warning float-end">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">The subject goes here</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item dropdown-footer" href="#">See All Messages</a>
                </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="text-secondary fs-7 float-end">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="text-secondary fs-7 float-end">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="text-secondary fs-7 float-end">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item dropdown-footer" href="#"> See All Notifications </a>
                </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="fullscreen" href="#">
                    <i class="bi bi-arrows-fullscreen" data-lte-icon="maximize"></i>
                    <i class="bi bi-fullscreen-exit" data-lte-icon="minimize" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <img alt="User Image" class="user-image rounded-circle shadow" src="{{ isset(Auth::user()->images["webp"]) ? Auth::user()->images["webp"] : asset("assets/img/user-avatar.png") }}" />
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">

                        <img alt="User Image" class="rounded-circle shadow" src="{{ isset(Auth::user()->images["webp"]) ? Auth::user()->images["webp"] : asset("assets/img/user-avatar.png") }}" />
                        <p>
                            {{ Auth::user()->name }}
                            <small>{{ Auth::user()?->Role?->name }}</small>
                        </p>
                    </li>
                    <!--end::User Image-->

                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <a class="btn btn-default btn-flat" href="{{ route("admin.profile.view") }}">Profile</a>
                        <a class="btn btn-default btn-flat float-end" href="{{ route("admin.logout.index") }}">Sign out</a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
