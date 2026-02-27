<!doctype html>
<html lang="en">
    <!--begin::Head-->

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>AdminLTE | Dashboard v2</title>
        <!--begin::Accessibility Meta Tags-->
        <meta content="width=device-width, initial-scale=1.0, user-scalable=yes" name="viewport" />
        <meta content="light dark" name="color-scheme" />
        <meta content="#007bff" media="(prefers-color-scheme: light)" name="theme-color" />
        <meta content="#1a1a1a" media="(prefers-color-scheme: dark)" name="theme-color" />
        <!--end::Accessibility Meta Tags-->

        <!--begin::Fonts-->
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" media="print" onload="this.media='all'" rel="stylesheet" />

        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet" />
        <link href="{{ asset("css/adminlte.min.css") }}" rel="stylesheet" />
        <!---- custom css linked ---->
        <link href="{{ asset("css/custom.css") }}" rel="stylesheet" />
        <!--end::Required Plugin(AdminLTE)-->
        @routes
        @stack("css")

    </head>

    <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
        <!--begin::App Wrapper-->
        <div class="app-wrapper">
            <!--begin::Header-->
            @include("admin.layouts.navbar")
            <!--end::Header-->
            <!--begin::Sidebar-->
            @include("admin.layouts.sidebar")
            <!--end::Sidebar-->
            <!--begin::App Main-->
            <main class="app-main">
                @if ($errors->any())
                    <div class="toast-container alert-box position-fixed end-0 top-0 p-3">
                        <div aria-atomic="true" aria-live="assertive" class="toast toast-danger fade show" id="toastPrimary" role="alert">
                            <div class="toast-header">
                                <i class="bi bi-circle me-2"></i>
                                <strong class="me-auto">Error</strong>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="toast" type="button"></button>
                            </div>
                            <div class="toast-body">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @session("success")
                    <div class="toast-container alert-box position-fixed end-0 top-0 p-3">
                        <div aria-atomic="true" aria-live="assertive" class="toast toast-success fade show" id="toastPrimary" role="alert">
                            <div class="toast-header">
                                <i class="bi bi-circle me-2"></i>
                                <strong class="me-auto">Success</strong>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="toast" type="button"></button>
                            </div>
                            <div class="toast-body">{{ session("success") }}</div>
                        </div>
                    </div>
                @endsession
                @session("error")
                    <div class="toast-container alert-box position-fixed end-0 top-0 p-3">
                        <div aria-atomic="true" aria-live="assertive" class="toast toast-danger fade show" id="toastPrimary" role="alert">
                            <div class="toast-header">
                                <i class="bi bi-circle me-2"></i>
                                <strong class="me-auto">Error</strong>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="toast" type="button"></button>
                            </div>
                            <div class="toast-body">{{ session("error") }}</div>
                        </div>
                    </div>
                @endsession
                @session("warning")
                    <div class="toast-container alert-box position-fixed end-0 top-0 p-3">
                        <div aria-atomic="true" aria-live="assertive" class="toast toast-warning fade show" id="toastPrimary" role="alert">
                            <div class="toast-header">
                                <i class="bi bi-circle me-2"></i>
                                <strong class="me-auto">Warning</strong>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="toast" type="button"></button>
                            </div>
                            <div class="toast-body">{{ session("warning") }}</div>
                        </div>
                    </div>
                @endsession
                @yield("content")
            </main>
            <!--end::App Main-->
            <!--begin::Footer-->
            @include("admin.layouts.footer")
            <!--end::Footer-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset("js/bootstrap.min.js") }}" crossorigin="anonymous"></script>
        <script src="{{ asset("js/jquery.min.js") }}" crossorigin="anonymous"></script>
        <script src="{{ asset("js/adminlte.min.js") }}"></script>
        <script src="{{ asset("js/script.js") }}" type="module"></script>

        @stack("js")
    </body>

</html>
