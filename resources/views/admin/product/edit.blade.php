@extends('admin.layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Update Product</h5>
                </div>
                <div>
                    <a href="{{ route('products') }}" class="btn btn-primary"><i class="bx bx-list-ol"></i> Product List</a> 
                </div>
            </div>
            <hr>
            
            <form action="{{ route('product-update',['id' => $data->id]) }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="col-md-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="single-select @error('category_id') is-invalid @enderror" id="category_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" @selected($cat->id == old('category_id', $data->category_id))>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" class="single-select @error('brand_id') is-invalid @enderror" id="brand_id">
                        <option selected disabled value="">Choose...</option>
                        @foreach ($brand as $cat)
                        <option value="{{ $cat->id }}" @selected($cat->id == old('brand_id', $data->brand_id))>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    <div class="col-md-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name', $data->name) }}">
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
                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" placeholder="Enter SKU" value="{{ old('sku ', $data->sku) }}" required>
                    @error('sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">Price <code>*</code></label>
                    <input type="number" name="price"  step=".01" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter Price" value="{{ old('price', $data->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="disc_price" class="form-label">Discount Price <code>*</code></label>
                    <input type="number" name="disc_price" step=".01" class="form-control @error('disc_price') is-invalid @enderror" id="disc_price" placeholder="Enter Discount" value="{{ old('disc_price', $data->disc_price) }}" required>
                    @error('disc_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="stock_quantity" class="form-label">Stock Quantity <code>*</code></label>
                    <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" placeholder="Enter Quantity" value="{{ old('stock_quantity', $data->stock_quantity) }}" required>
                    @error('stock_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="image" class="form-label">Old Image</label>
                    @foreach ($data->image as $img)
                        <img src="{{ asset('images/product/' . $img) }}" onerror="this.onerror=null;this.src='{{ asset('images/missing-image.png') }}';"  class="product-img-2" alt="img" style="margin-right: 8px;"> 
                    @endforeach
                </div>
                  
                <div class="align-items-center">
                    <h6 class="mb-0 text-primary">Update Variation</h6>
                </div>

                <div class="col-md-12">
                    <div id="variation-wrapper">
                        @if($data->variations->isNotEmpty())
                        @foreach($data->variations as $index => $v)
                        <div class="row variation-row mb-2 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label">Variation Type</label>
                                <select name="variation_type[]" 
                                        class="form-control variation_type"
                                        onchange="handleVariationTypeChange(this)">
                                    <option disabled>Choose...</option>

                                    @foreach($variationType as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $v->variation_type_id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Variation Value</label>
                                <select name="variation_value[]" 
                                        class="form-control variation_value"
                                        data-selected="{{ $v->variation_value_id }}">
                                    <option disabled selected>Choose...</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                @if($index == 0)
                                    <button type="button" class="btn btn-primary btn-add">+</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-remove">-</button>
                                @endif
                            </div>

                        </div>
                        @endforeach
                                 @else
                    {{-- NO VARIATION EXISTS → SHOW EMPTY ROW --}}
                    <div class="row variation-row mb-2 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label">Variation Type</label>
                            <select name="variation_type[]"
                                    class="form-control variation_type"
                                    onchange="handleVariationTypeChange(this)">
                                <option disabled selected>Choose...</option>
                                @foreach($variationType as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <div class="col-md-4">
                                <label class="form-label">Variation Value</label>
                                <select name="variation_value[]"
                                        class="form-control variation_value">
                                    <option disabled selected>Choose...</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-add">+</button>
                            </div>

                        </div>
                    @endif

                    </div>
                    </div>
  
                <div class="row variation-row template-row mb-2 align-items-end" style="display: none">
                    <div class="col-md-4">
                        <label class="form-label">Variation Type</label>
                        <select name="variation_type[]" class="form-control variation_type" onchange="handleVariationTypeChange(this)">
                            <option disabled selected>Choose...</option>
                            @foreach($variationType as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Variation Value</label>
                        <select name="variation_value[]" class="form-control variation_value">
                            <option disabled selected>Choose...</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-add">+</button>
                    </div>
                </div>



                <div class="align-items-center">
                    <h6 class="mb-0 text-primary">Update Additional</h6>
                </div>

                <div class="col-md-12">
                    <div id="additional-wrapper">
                        @if(!empty($data->charge_details))
                        @foreach($data->charge_details ?? [] as $index => $cd)
                        <div class="row additional-row mb-2 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label">Name</label>
                                <input type="text"
                                    name="additional_name[]"
                                    class="form-control additional_name"
                                    value="{{ $cd['name'] }}"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Charge</label>
                                <input type="number"
                                    step=".01"
                                    name="charge[]"
                                    class="form-control charge"
                                    value="{{ $cd['charge'] }}"
                                    required>
                            </div>

                            <div class="col-md-4">
                                @if($index == 0)
                                    <button type="button" class="btn btn-primary btn-add-additional">+</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-remove-additional">-</button>
                                @endif
                            </div>

                        </div>
                        @endforeach
                        
                            @else
                                {{-- NO ADDITIONAL CHARGE EXISTS --}}
                                <div class="row additional-row mb-2 align-items-end">

                                    <div class="col-md-4">
                                        <label class="form-label">Name</label>
                                        <input type="text"
                                            name="additional_name[]"
                                            class="form-control additional_name"
                                            placeholder="Name">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Charge</label>
                                        <input type="number"
                                            step=".01"
                                            name="charge[]"
                                            class="form-control charge"
                                            placeholder="Charge">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary btn-add-additional">+</button>
                                    </div>

                                </div>
                            @endif
                    </div>
                </div>

                <div class="row additional-row template-row mb-2 align-items-end" style="display: none">
                    <div class="col-md-4">
                        <input type="text" name="additional_name[]" class="form-control additional_name" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <input type="number" step=".01" name="charge[]" class="form-control charge" placeholder="Charge">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-add-additional">+</button>
                    </div>
                </div>


                <div class="col-md-12">
                    <label for="content" class="form-label">Specification <code>*</code></label>
                    <textarea id="editor" name="content">{!! old('content', $data->specifications) !!}</textarea>
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

$(document).ready(function () {
    $('#variation-wrapper .variation-row').each(function () {
        let $row = $(this);
        let typeId = $row.find('.variation_type').val();
        let selectedValue = $row.find('.variation_value').data('selected');

        if (typeId) {
            getVariationvalue(typeId, $row.find('.variation_value'), selectedValue);
        }
    });
});



    function getVariationvalue(variationTypeId,valueSelectId, selectedValueId= null) {

    const $valueSelect = $(valueSelectId);

    $valueSelect.empty();
    $valueSelect.html('<option disabled selected>Loading...</option>');
    $valueSelect.trigger('change');

    const isSelectedValid = selectedValueId !== null && selectedValueId !== undefined && selectedValueId !== '';

    $.ajax({
        url: "{{ route('get-variation-value', ':id') }}".replace(':id', variationTypeId),
        method: 'GET',
        success: function(data) {

            $valueSelect.empty();

            if (!isSelectedValid) {
                $valueSelect.append('<option disabled selected>Choose...</option>');
            }

            data.forEach(function(item) {
                const isSelected = isSelectedValid && item.id == selectedValueId;
                const option = new Option(item.name, item.id, isSelected, isSelected);
                $valueSelect.append(option);
            });

            $valueSelect.trigger('change');
        },
        error: function(xhr, status, error) {
            $valueSelect.empty();
            $valueSelect.trigger('change');
        }
    });
}


function handleVariationTypeChange(selectElement) {
    let $current = $(selectElement);
    let typeId = $current.val();
    let $currentRow = $current.closest('.variation-row');

    // Check duplicate
    let isDuplicate = false;
    $('#variation-wrapper .variation-row').not('.template-row').not($currentRow).each(function () {
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

        // Load variation values
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

    // Clone template
    let $clone = $('.variation-row.template-row').first().clone();
    $clone.removeClass('template-row').show();

      $clone.find('.variation_type').val('');
      $clone.find('.variation_value')
        .html('<option disabled selected>Choose...</option>')
        .removeAttr('data-selected');


    // Convert + to -
    $clone.find('.btn-add')
        .text('-')
        .removeClass('btn-add btn-primary')
        .addClass('btn-remove btn-danger');

    $('#variation-wrapper').append($clone);
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

    let isDuplicate = false;
    $('#additional-wrapper .additional-row').not('.template-row').not($row).each(function () {
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
    $clone.removeClass('template-row').show();

    $clone.find('.additional_name').val(nameVal);
    $clone.find('.charge').val(chargeVal);

    // Convert + to -
    $clone.find('.btn-add-additional')
        .text('-')
        .removeClass('btn-add-additional btn-primary')
        .addClass('btn-remove-additional btn-danger');

    $('#additional-wrapper').append($clone);

    // Reset template
        $row.find('.additional_name').val('');
    $row.find('.charge').val('');
});



$(document).on('click', '.btn-remove-additional', function () {
    $(this).closest('.additional-row').remove();
});
    


	</script>
@endpush
