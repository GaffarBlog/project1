@extends("admin.layouts.main")
@section("content")
    <!--------Page Heading & Breadcrumb---------->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Product</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
                        @if (has_permission("admin.products.view"))
                            <a class="btn btn-info btn-sm text-light me-2" href="{{ route("admin.products.view") }}">Products List</a>
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
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Product Form</div>
                    </div>
                </div>
                <div class="card-body p-3 pb-3">
                    <form action="{{ route("admin.products.create") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row row-gap-3">

                            {{-- SECTION: Basic Information --}}
                            <div class="col-md-12">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 pb-2">Basic Information</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="productTitle">Title <span class="text-danger">*</span></label>
                                    <input class="form-control" id="productTitle" name="title" placeholder="e.g. Cotton Summer Shirt" required type="text" value="{{ old("title") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="productSku">SKU <span class="text-danger">*</span></label>
                                    <input class="form-control" id="productSku" name="sku" placeholder="e.g. SKU-00123" required type="text" value="{{ old("sku") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control product_category" name="category_id">
                                        <option disabled selected>Select Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subcategory</label>
                                    <select class="form-control product_subcategories" name="subcategories_id">
                                        <option disabled selected>Select Category First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Unit</label>
                                    <select class="form-control" name="unit_id">
                                        <option disabled selected>Select Unit</option>
                                        {{-- @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" id="isFeatured" name="is_featured" role="switch" type="checkbox">
                                    <label class="form-check-label" for="isFeatured">Mark as Featured Product</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="productShortDesc">Short Description</label>
                                    <textarea class="form-control" name="short_description" placeholder="Brief summary shown in product listings..." rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="productDesc">Full Description</label>
                                    <textarea id="summernote" name="description" placeholder="Detailed product description..."></textarea>
                                </div>
                            </div>

                            {{-- SECTION: Pricing --}}
                            <div class="col-md-12 mt-5">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 mt-2 pb-2">Pricing & Discount</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="productPrice">Original Price <span class="text-danger">*</span></label>
                                    <input class="form-control" id="productPrice" name="price" placeholder="0.00" required type="number" value="{{ old("price") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="productDiscountType">Discount Type</label>
                                    <select class="form-control" id="productDiscountType" name="discount_type">
                                        <option disabled selected>Select Discount Type</option>
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="fixed">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="productDiscount">Discount Value</label>
                                    <input class="form-control" id="productDiscount" name="discount" placeholder="0" type="number" value="{{ old("discount", 0) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Discount Start Date</label>
                                    <input class="form-control" name="discount_start_date" type="date" value="{{ old("discount_start_date") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Discount End Date</label>
                                    <input class="form-control" name="discount_end_date" type="date" value="{{ old("discount_end_date") }}">
                                </div>
                            </div>

                            {{-- SECTION: Inventory --}}
                            <div class="col-md-12 mt-5">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 mt-2 pb-2">Inventory</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Quantity in Stock</label>
                                    <input class="form-control" name="quantity" placeholder="0" type="number" value="{{ old("quantity", 0) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Low Stock Alert Threshold</label>
                                    <input class="form-control" name="low_stock_threshold" placeholder="5" type="number" value="{{ old("low_stock_threshold", 5) }}">
                                    <small class="text-muted">You'll be alerted when stock drops below this number.</small>
                                </div>
                            </div>

                            {{-- SECTION: Shipping --}}
                            <div class="col-md-12 mt-5">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 mt-2 pb-2">Shipping</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Free Shipping?</label>
                                    <select class="form-control" name="is_free_shipping">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Shipping Method</label>
                                    <select class="form-control" name="shipping_id">
                                        <option disabled selected>Select Shipping Method</option>
                                        {{-- @foreach ($shippings as $shipping)
                                        <option value="{{ $shipping->id }}">{{ $shipping->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            {{-- SECTION: Warranty --}}
                            <div class="col-md-12 mt-5">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 mt-2 pb-2">Warranty</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Warranty Available?</label>
                                    <select class="form-control" name="is_warranty">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Warranty Plan</label>
                                    <select class="form-control" name="warranty_id">
                                        <option disabled selected>Select Warranty</option>
                                        {{-- @foreach ($warranties as $warranty)
                                        <option value="{{ $warranty->id }}">{{ $warranty->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            {{-- SECTION: Visibility & SEO --}}
                            <div class="col-md-12 mt-5">
                                <h6 class="text-muted fw-semibold border-bottom border-secondary mb-2 mt-2 pb-2">Visibility & SEO</h6>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tags <small class="text-muted">(comma separated)</small></label>
                                    <input class="form-control" name="tags" placeholder="shirt, cotton, summer" type="text" value="{{ old("tags") }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <input class="form-control" name="meta_title" placeholder="SEO-friendly title for search engines" type="text" value="{{ old("meta_title") }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" placeholder="Brief description shown in search engine results..." rows="3">{{ old("meta_description") }}</textarea>
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

@push("js")
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="{{ asset("js/admin/products/products.js") }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
