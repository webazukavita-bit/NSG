

@extends('admin.layouts.app')

@section('content')

<style>
    .select2-container--bootstrap4 .select2-selection--multiple {
    min-height: 38px !important;
    padding: 4px 6px;
    border-radius: 4px;
}

</style>
  <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Add Product</h5>
                </div>
                <div>
                    <a href="{{ route('products') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Product List</a> 
                </div>
            </div>
            <hr>
            
            <form action="{{ route('product-add') }}" method="POST" class="row g-3" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('slug')
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
                    <label for="max_quantity" class="form-label">Max Quantity <code>*</code></label>
                    <input type="number" name="max_quantity" class="form-control @error('max_quantity') is-invalid @enderror" id="max_quantity" placeholder="Enter Max Quantity" value="{{ old('max_quantity') }}" required>
                    @error('max_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="min_quantity" class="form-label">Min Quantity <code>*</code></label>
                    <input type="number" name="min_quantity" class="form-control @error('min_quantity') is-invalid @enderror" id="min_quantity" placeholder="Enter Min Quantity" value="{{ old('min_quantity') }}" required>
                    @error('min_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                 

                            <div class=" align-items-center">
                               <h6 class="mb-0 text-primary">Add Variation</h6>
                            </div>
                            <div class="col-md-12">
                                <div id="variation-wrapper">
                                <div class="row align-items-end variation-row template-row">
                                    <div class="col-md-4">
                                        <label class="form-label">Variation Type</label>
                                        <select name="variation_type[]" class="form-control variation_type"    onchange="handleVariationTypeChange(this)">
                                            <option value="" selected disabled>Choose...</option>
                                            @foreach ($variationType as $type)
                                    <option value="{{ $type->id }}" 
                                        @selected(is_array(old('variation_type')) && in_array($type->id, old('variation_type')))>
                                        {{ $type->name }}
                                    </option>

                                            @endforeach
                                        </select>
                                    @error('variation_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                    </div>


                                    <div class="col-md-4">
                                        <label class="form-label">Variation Value</label>
                                       <select class="variation_value multi-select form-control w-100" name="variation_value[0][]"  multiple  data-placeholder="Select values">
                                       </select>
                                               @error('variation_value')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary btn-add" id="button-plus">+</button>
                                        </div>
                                </div>
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
        
    function initMultiSelect($el) {

    if ($el.hasClass("select2-hidden-accessible")) {
        $el.select2('destroy');
    }

    $el.select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: $el.data('placeholder') || 'Select values',
        closeOnSelect: false,
        allowClear: true,
        hideSelected: true   // KEY LINE
    });
}


    $('.variation_value').each(function () {
    initMultiSelect($(this));
    $(this).prop('disabled', true);
});




function getVariationvalue(typeId, $valueSelect) {

    // Enable select
    $valueSelect.prop('disabled', false);

    // Clear old options
    $valueSelect.empty();

    $.ajax({
        url: "{{ route('get-variation-value', ':id') }}".replace(':id', typeId),
        type: 'GET',
        success: function (data) {

            data.forEach(item => {
                $valueSelect.append(
                    $('<option>', {
                        value: item.id,
                        text: item.name
                    })
                );
            });

            // Refresh Select2
            $valueSelect.trigger('change');
        }
    });
}




function handleVariationTypeChange(selectElement) {
    let $current = $(selectElement);
    let typeId = $current.val();

    let isDuplicate = false;
    $('#variation-wrapper .variation-row').not('.template-row').each(function () {
        let existing = $(this).find('.variation_type').val();
        if (existing == typeId) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        alert('This variation type is already selected.');
        $current.val('').trigger('change');
        return;
    }

    let $valueSelect = $current.closest('.variation-row').find('.variation_value');
    getVariationvalue(typeId, $valueSelect);


}




$(document).on('click', '.btn-add', function () {
    let $row = $(this).closest('.variation-row');

    let typeVal = $row.find('.variation_type').val();
    let valueVal = $row.find('.variation_value').val();

    if (!typeVal || !valueVal) {
        alert('Please select both Variation Type and Value before adding.');
        return;
    }

    let $clone = $('.variation-row.template-row').clone();
    $clone.removeClass('template-row');

    $clone.find('.variation_type').val(typeVal);
    $clone.find('.variation_value').val(valueVal);

    // Convert + to -
    $clone.find('.btn-add')
        .text('-')
        .removeClass('btn-add btn-primary')
        .addClass('btn-remove btn-danger');

    $('#variation-wrapper').append($clone);

    // Reset template row
        let $template = $('.variation-row.template-row');
        $template.find('.variation_type').val('').trigger('change');

        let $valueSelect = $template.find('.variation_value');
        $valueSelect.val(null).trigger('change');
        $valueSelect.prop('disabled', true);

});




$(document).on('click', '.btn-remove', function() {
    $(this).closest('.variation-row').remove();
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