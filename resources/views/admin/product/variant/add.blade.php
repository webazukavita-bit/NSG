

@extends('admin.layouts.app')

@section('content')

  <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Add Variant</h5>
                </div>
                <div>
                    <a href="{{ route('variant') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Product Variant List</a> 
                </div>
            </div>
            <hr>
            
            <form action="{{ route('variant-add') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="single-select @error('category_id') is-invalid @enderror" id="category_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" @selected($cat->id == old('category_id'))>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="parent_product_id" class="form-label">Product</label>
                    <select name="parent_product_id" class="single-select @error('parent_product_id') is-invalid @enderror" id="parent_product_id">
                        <option selected disabled value="">Choose...</option>
                    </select>
                    @error('parent_product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" class="single-select @error('brand_id') is-invalid @enderror" id="brand_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($brand as $cat)
                        <option value="{{ $cat->id }}" @selected($cat->id == old('brand_id'))>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="name" class="form-label">Name <code>*</code></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="image" class="form-label">Thumbnail <code>*</code></label>
                    <input type="file" name="images[]" multiple class="form-control @error('image') is-invalid @enderror" id="image" placeholder="Enter Name" value="{{ old('image') }}" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="sku" class="form-label">SKU <code>*</code></label>
                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" placeholder="Enter SKU" value="{{ old('sku') }}" required>
                    @error('sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">Price <code>*</code></label>
                    <input type="number" name="price" step=".01" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter Price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="disc_price" class="form-label">Discount Price <code>*</code></label>
                    <input type="number" name="disc_price" step=".01" class="form-control @error('disc_price') is-invalid @enderror" id="disc_price" placeholder="Enter Discount" value="{{ old('disc_price') }}" required>
                    @error('disc_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="stock_quantity" class="form-label">Stock Quantity <code>*</code></label>
                    <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" placeholder="Enter Quantity" value="{{ old('stock_quantity') }}" required>
                    @error('stock_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    {{-- <div class="col-md-3">
                        <label class="form-label">Product Images</label>
                        <div id="product-images">
                        </div>
                    </div> --}}

                 

                            <div class=" align-items-center">
                               <h6 class="mb-0 text-primary">Variations</h6>
                            </div>
                            <div class="col-md-12">
                                <div id="variation-wrapper">

                                </div>
                            </div>




                                <div class=" align-items-center">
                                <h6 class="mb-0 text-primary">Additional</h6>
                                </div>
                        <div class="col-md-12">
                            <div id="additional-wrapper">
                                <div class="row align-items-end additional-row template-row">       
                                    <div class="col-md-4">
                                    <label for="additional_name" class="form-label">Name</label>
                                    <input type="text" name="additional_name[]" class="form-control additional_name  @error('additional_name') is-invalid @enderror" id="additional_name" placeholder="Enter Name" value="{{ old('additional_name.0') }}" required>
                                    @error('additional_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>  
                                    <div class="col-md-4">
                                    <label for="charge" class="form-label">charge</label>
                                    <input type="number" name="charge[]" step=".01" class="form-control charge @error('charge') is-invalid @enderror" id="charge" placeholder="Enter charge" value="{{ old('charge.0') }}" required>
                                    @error('charge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div> 
                                    <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-add-additional" id="button-plus">+</button>
                                    </div> 
                                </div>
                            </div>
                        </div>



                <div class="col-md-12">
                    <label for="content" class="form-label">Specification <code>*</code></label>
                    <textarea id="editor" name="content">{!! old('content') !!}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-send"></i> Save</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

        tinymce.init({
            selector: '#editor',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | bold italic | bullist numlist | link image | code'
        });
        $(document).ready(function() {
            setTimeout(function() {
                $('.tox-promotion').remove();
                $('.tox-statusbar__branding').remove();
                $('.tox-editor-header').addClass('d-flex');
                
            }, 10);
        });



function loadProductsByCategory(categoryId) {
    let $product = $('#parent_product_id');
    $product.html('<option selected disabled>Loading...</option>');

    $.get("{{ route('category-products') }}", { category_id: categoryId }, function(res) {
        $product.empty().append('<option selected disabled>Choose...</option>');
        res.products.forEach(p => {
            $product.append(`<option value="${p.id}">${p.name}</option>`);
        });
        $product.prop('disabled', false).trigger('change');
    });
}

$('#category_id').change(function() {
    let categoryId = $(this).val();
    if (categoryId) loadProductsByCategory(categoryId);
});


function loadProductDetails(productId) {
    $.get("{{ route('product-details') }}", { product_id: productId }, function(res) {
        let product = res.product;


        $('#brand_id').html(`<option value="${product.brand.id}" selected>${product.brand.name}</option>`);

        $('#price').val(product.price);
        $('#disc_price').val(product.disc_price);
        $('#stock_quantity').val(product.stock_quantity);
        tinymce.get('editor').setContent(product.specifications ?? '');

        // Product images
        // $('#product-images').empty();
        // product.image.forEach(img => {
        //     $('#product-images').append(`<img src="/images/product/${img}" height="60">`);
        // });

        // Variations
        $('#variation-wrapper').empty();
product.variations.forEach(v => {

    let $row = $(`
        <div class="row mb-2">
            <div class="col-md-4">
                <label class="form-label">Variation Type</label>
                <input type="hidden" name="variation_type[]" value="${v.variation_type_id}">
                <input type="text" class="form-control" value="${v.variation_type.name}" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Variation Value</label>
                <select name="variation_value[]" class="form-control variation_value">
                    <option value="">Select value</option>
                </select>
            </div>
        </div>
    `);

    $('#variation-wrapper').append($row);

    let $select = $row.find('.variation_value');

    $.get(
        "{{ route('get-variation-value', ':id') }}".replace(':id', v.variation_type_id),
        function(values) {
            $select.empty().append('<option value="">Select value</option>');

            values.forEach(val => {
                $select.append(`
                    <option value="${val.id}" ${Number(val.id) === Number(v.variation_value_id) ? 'selected' : ''}>
                        ${val.name}
                    </option>
                `);
            });
        }
    );
});

    });
}

// Trigger on product change
$('#parent_product_id').change(function() {
    let productId = $(this).val();
    if (productId) loadProductDetails(productId);
});




$(document).on('click', '.btn-add-additional', function () {
    let $row = $(this).closest('.additional-row');

    let nameVal = $row.find('.additional_name').val().trim();
    let chargeVal = $row.find('.charge').val();

    if (!nameVal || !chargeVal) {
        alert('Please enter both Name and Charge before adding.');
        return;
    }

    // Check duplicate name
    let isDuplicate = false;
    $('#additional-wrapper .additional-row').not('.template-row').each(function () {
        let existing = $(this).find('.additional_name').val().trim();
        if (existing.toLowerCase() === nameVal.toLowerCase()) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        alert('This Name is already added.');
        return;
    }

    // Clone row
    let $clone = $('.additional-row.template-row').clone();
    $clone.removeClass('template-row');

    $clone.find('.additional_name').val(nameVal);
    $clone.find('.charge').val(chargeVal);

    // Convert + to -
    $clone.find('.btn-add-additional')
        .text('-')
        .removeClass('btn-add-additional btn-primary')
        .addClass('btn-remove-additional btn-danger');

    $('#additional-wrapper').append($clone);

    // Reset template
    $('.additional-row.template-row').find('input').val('');
});



$(document).on('click', '.btn-remove-additional', function () {
    $(this).closest('.additional-row').remove();
});









	</script>
@endpush
