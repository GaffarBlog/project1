@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Attributes Management</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.products.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.products.view") }}">Products</a>
                        @endif
                        @if (has_permission("admin.categories.view"))
                            <a class="btn btn-info btn-sm text-light" href="{{ route("admin.categories.view") }}">Categories</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------Page Content---------->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $attr === "units" ? "active" : "" }} text-black" href="{{ route("admin.attributes.view", ["attr" => "units"]) }}" type="button">Product Units</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $attr === "warranties" ? "active" : "" }} text-black" href="{{ route("admin.attributes.view", ["attr" => "warranties"]) }}" type="button">Warranties</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $attr === "shipping" ? "active" : "" }} text-black" href="{{ route("admin.attributes.view", ["attr" => "shipping"]) }}" type="button">Shipping</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if ($attr === "units")
                        <div>
                            Units
                        </div>
                    @elseif($attr === "warranties")
                        <div>
                            warranties
                        </div>
                    @elseif($attr === "shipping")
                        <div>
                            shipping
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
