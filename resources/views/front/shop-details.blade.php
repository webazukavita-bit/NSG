@extends('front.layouts.app')
@section('content')
  <!--<< Breadcrumb Section Start >>-->
     <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Shop Details</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{url('/')}}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Shop Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
       
    <!-- Shop Details Section Start -->
    <section class="shop-details-section section-padding pt-2">
        <div class="container">
        <div class="shop-details-wrapper">
        <form action="#" method="POST" enctype="multipart/form-data">
          @csrf   
         <div class="row justify-content-start mb-4">
           <div class="col-lg-6 col-md-8 col-sm-12">  
                                    <label class="form-label text-base mt-5 w-100 fw-semibold">
                                        SELECT PRODUCT <code>*</code>
                                    </label>

                                    <select name="product_id"
                                            id="productSelect"
                                            class="form-select text-center py-2 bg-light"
                                            onchange="productDetails()"
                                            required>
                                        
                                        <option value="" selected disabled>-- Choose Product --</option>

                                        @foreach ($product as $pro)
                                            <option value="{{ $pro->id }}"
                                                data-name="{{ $pro->name }}"
                                                data-sku="{{ $pro->sku }}"
                                                data-category="{{ $pro->category->name }}"
                                                data-variations='@json($pro->variations)'
                                                data-charge_details='@json($pro->charge_details)'
                                                data-disc_price="{{ $pro->disc_price }}"
                                               data-specifications="{{ htmlentities($pro->specifications) }}"
                                                data-quantity="{{ $pro->stock_quantity }}">
                                                {{ $pro->name }}
                                                {{-- @foreach ($pro->variations as $variant)
                                          {{$variant->variationType->name?' + '.$variant->variationType->name:''}} @endforeach --}}
                                            </option>
                                        @endforeach
                                    </select>

                                    
                                    @error('category_id')
                                        <div class="invalid-feedback text-center d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>


                       <div class="row"  id="productFields" style="display: none">

                                <div class="col-lg-7">
                                        <div class="product-details-content">
                                            <h2 class="pb-2" id="product_name"></h2>

                                            <div class="d-flex gap-4 align-items-center mb-3">
                                                <div>
                                                    <strong class="text-dark">SKU:</strong>
                                                    <span id="product_sku"></span>
                                                </div>
                                                <div>
                                                    <strong class="text-dark">Categories:</strong>
                                                    <span id="product_category"></span>
                                                </div>
                                            </div>

                                            {{-- Product Details --}}
                                        <div id="productStep">
                                            <div class="card border-rounded p-2">
                                                <h6 class="text-base ps-2 border-bottom fs-6 py-1">SELECT DETAIL</h6>

                                                <div class="row px-2 pt-1" id="variationContainer"></div>

                                                <h6 class="text-base border-top ps-2 pt-1 fs-6">SELECT FILE OPTION</h6>
                                                <div class="row px-2 mb-2">
                                                    <div class="col-md-6 d-flex flex-column">
                                                        <div>
                                                            <input type="radio" name="file_option" id="file_online" value="online">
                                                            <label class="fw-semibold small" for="file_online">Attach file Online</label>
                                                        </div>
                                                        <div id="online_info" class="d-none small mt-1">
                                                            <p class="mb-0" style="font-size: 10px">(Allowed File: 96x58 mm, 30MB, PDF Only)</p>
                                                            <button class="btn btn-primary btn-sm rounded-pill">more info</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 d-flex flex-column">
                                                        <div>
                                                            <input type="radio" name="file_option" id="file_email" value="email">
                                                            <label class="fw-semibold small" for="file_email">Send file via Email</label>
                                                        </div>
                                                        <div id="email_info" class="d-none small mt-1 text-danger">
                                                            <p class="mb-0">(Extra Charges - Rs.20.00)</p>
                                                            <button class="btn btn-danger btn-sm rounded-pill">more info</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Additional Charge  --}}
                                                   <div id="dynamicChargeSection"></div>
                                                 
                                                <!-- COST SECTION -->
                                                <div class="px-2">
                                                        <h6 class="text-base py-1 border-top">Congratulations! Order's eligible for free delivery</h6>
                                                    <div class="row mb-2 align-items-center ps-2">
                                                        <div class="col-md-4">
                                                            <label class="form-label text-dark pt-1 small">Quantity</label>
                                                        </div>
                                                        <div class="col-md-3 ms-2">
                                                            <input type="number" name="quantity" id="stock_quantity" class="form-control form-control-sm" step="1">
                                                        </div>
                                                        <div class="col-md-3 pt-1 text-muted small">
                                                            (Min Qty : <span id="minQty"></span>)
                                                        </div>
                                                    </div>  
                                                    <div class="row py-1 border-top">
                                                        <div class="col-6 small">Cost</div>
                                                        <div class="col-6 text-end small" id="disc_price"></div>
                                                    </div>

                                                    <div class="row py-1 border-top">
                                                        <div class="col-6 small">GST (18.00%)</div>
                                                        <div class="col-6 text-end small" id="gst_amount">Rs. 0/-</div>
                                                    </div>

                                                    <div class="row mb-2 border-top">
                                                        <div class="col-6 fw-bold small">Amount Payable</div>
                                                        <div class="col-6 fw-bold text-end small" id="amount_payable">Rs. 0/-</div>
                                                    </div>

                                                    <div class="row py-1 border-top">
                                                        <div class="col-4">
                                                            <label class="form-label small">Special Remark (Optional)</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <textarea class="form-control form-control-sm" placeholder="remarks for order processing team..."></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row border-top pt-1">
                                                        <div class="col-4 mb-0">Enter Pressline:
                                                            <p class="text-danger small m-0" style="font-size:12px">To be Printed on Free Gift(Card Holder)</p>
                                                            
                                                        </div>
                                                        <div class="col-8 mb-0">
                                                            <input type="text" class="form-control form-control-sm text-muted" value="A PRINT MASTER">
                                                        </div>
                                                    </div>

                                                </div>

                                                <button type="button" class="btn theme-btn btn-sm mt-2" onclick="validateProductStep()">
                                                        Add User Details
                                                    </button>


                                            </div>
                                        </div>   
                                               {{-- .Product Details End --}}

                                                            {{-- User details --}}
                                                            <div id="userStep" class="d-none border rounded p-2 shadow-sm">

                                                                <h3 class="mb-2 text-base text-dark">User Details</h3>

                                                                <div class="row g-3">

                                                                    <div class="col-md-6 border-top mb-2 pt-2">
                                                                        <label class="form-label text-dark">Full Name <strong class="text-danger">*</strong></label>
                                                                        <input type="text" name="name" class="form-control" required>
                                                                    </div>

                                                                    <div class="col-md-6 border-top mb-2 pt-2">
                                                                        <label class="form-label text-dark">Phone <strong class="text-danger">*</strong></label>
                                                                        <input type="text" name="phone" class="form-control" required>
                                                                    </div>

                                                                    <div class="col-md-6 border-top mb-2 pt-2">
                                                                        <label class="form-label text-dark">Email <strong class="text-danger">*</strong></label>
                                                                        <input type="email" name="email" class="form-control" required>
                                                                    </div>

                                                                    <div class="col-lg-6 border-top mb-2 pt-2">
                                                                        <label class="form-label text-dark">Address <strong class="text-danger">*</strong></label>
                                                                        <textarea name="address" class="form-control" rows="1" required></textarea>
                                                                    </div>

                                                        <div class="col-md-6 mb-3 border-top">
                                                            <label for="country" class="form-label">country<code>*</code></label>
                                                            <select name="country" class="single-select @error('country') is-invalid @enderror" id="country" onchange="getStates(this.value)">
                                                                {{-- <option selected disabled value="">Choose...</option> --}}
                                                                @foreach ($countrie as $country)
                                                                <option value="{{ $country->id }}" @selected($country->id == old('country', $country_id))>{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6 mb-3 border-top">
                                                            <label for="state" class="form-label">State<code>*</code></label>
                                                            <select name="state" class="single-select @error('state') is-invalid @enderror" id="state" onchange="getCities(this.value)">
                                                                <option selected disabled value="">Choose...</option>                    
                                                                @foreach ($states as $state)
                                                                <option value="{{ $state->id }}" @selected($state->id == old('state'))>{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('state')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6 mb-3 border-top">
                                                            <label for="city" class="form-label">City<code>*</code></label>
                                                            <select name="city" class="single-select @error('city') is-invalid @enderror" id="city">
                                                                <option selected disabled value="">Choose...</option>
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}" @selected($city->id == old('city'))>{{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                                    <div class="col-lg-6 border-top mb-2 pt-2">
                                                                        <label class="form-label text-dark">Zip Code <strong class="text-danger">*</strong></label>
                                                                        <input type="text" name="zipcode" class="form-control" required>
                                                                    </div>

                                                                    <!-- PAYMENT METHOD -->
                                                                    <h6 class="text-base border-top pt-2 fs-6 mt-3">
                                                                        SELECT PAYMENT OPTION <strong class="text-danger">*</strong>
                                                                    </h6>
                                                                    <div class="row px-2 mb-2 border-bottom pb-2">
                                                                        <div class="col-md-6 d-flex flex-column">
                                                                            <div>
                                                                                <input type="radio" name="payment_option" id="file_online" value="cod">
                                                                                <label class="fw-semibold small text-dark" for="file_online">Cash On Delivery</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 d-flex flex-column">
                                                                            <div>
                                                                                <input type="radio" name="payment_option" id="file_email" value="online">
                                                                                <label class="fw-semibold small text-dark" for="file_email">Online</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 mt-2 d-flex gap-2">
                                                                        <button type="button" class="btn btn-secondary" onclick="backToProduct()">
                                                                            Back
                                                                        </button>

                                                                        <button type="submit" class="btn theme-btn">
                                                                            Place Order
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            {{-- User Details End --}}
                                            </div>
                                           </div>
                                            </form>                       
                                            <div class="col-lg-5 ">
                                            <div class="shop-details-image "  style="margin-top: 105px;">
                                                @foreach ($product as $pro)
                                                    <div class="product-images d-none" id="product-images-{{ $pro->id }}">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active">
                                                                <div class="shop-thumb mt-5">
                                                                    <img src="{{ asset('images/variant/'.$pro->image[0]) }}" alt="img"
                                                                     onerror="this.onerror=null;this.src='{{ asset('images/missing-image.png') }}';">
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <ul class="nav mb-5">
                                                            @foreach ($pro->image as $img)
                                                            <li class="nav-item">
                                                                <a class="nav-link ps-0">
                                                                    <img src="{{ asset('images/variant/'.$img) }}" alt="img"  onerror="this.onerror=null;this.src='{{ asset('images/missing-image.png') }}';">
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                            @endforeach
                                            </div>
                                        </div>
                        </div>
            <div class="single-tab">
                <ul class="nav mb-5">
                    <li class="nav-item">
                    {{-- <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active">
                        <h6></h6>
                    </a> --}}
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
                    <div class="description-items">
                        <div class="description-content">
                            <h3>Product descriptions</h3>
                            <p class="mb-2" id="productSpecifications">
                            </p>
                            <div class="description-list-items d-flex justify-content-between" id="productVariationsDesc">
                            </div>
                        </div>
                    </div>
                    </div>
                   
                    
                </div>
            </div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    function validateProductStep() {
        let productSelect = document.getElementById('productSelect');
        if (!productSelect.value) {
            alert('Please select a product first');
            productSelect.focus();
            return;
        }
        let variationSelects = document.querySelectorAll('#variationContainer select');

        for (let select of variationSelects) {
            if (!select.value) {
                alert('Please select all product variations');
                select.focus();
                return;
            }
        }
        let qty = document.getElementById('stock_quantity').value;
        if (!qty || qty <= 0) {
            alert('Please enter valid quantity');
            document.getElementById('stock_quantity').focus();
            return;
        }
        let fileSelected = document.querySelector('input[name="file_option"]:checked');
        if (!fileSelected) {
            alert('Please select file option');
            return;
        }

        /* -------- DYNAMIC CHARGES (AUTO OK) -------- */
        // No validation required because default = Not Required

        /* -------- ALL GOOD → GO NEXT -------- */
        goToUserDetails();
    }

    function goToUserDetails()
     {
            document.getElementById('productStep').classList.add('d-none');
            document.getElementById('userStep').classList.remove('d-none');
            window.scrollTo(0, 0);
     }

    function backToProduct()
     {

        document.getElementById('userStep').classList.add('d-none');
        document.getElementById('productStep').classList.remove('d-none');
    }




    window.productDetails = function () {

    let select = document.getElementById('productSelect');
    let option = select.options[select.selectedIndex];
    let productId = select.value;

    if (!productId) return;

    document.getElementById('productFields').style.display = 'flex';

    document.getElementById('product_name').innerText =
    option.getAttribute('data-name');
     document.getElementById('product_sku').innerText = option.getAttribute('data-sku');

   document.getElementById('product_category').innerText = option.getAttribute('data-category');

     let discPrice = parseFloat(option.getAttribute('data-disc_price')) || 0;
    let qty = parseInt(option.getAttribute('data-quantity')) || 1;
  
    document.getElementById('stock_quantity').value = qty;
    document.getElementById('minQty').innerText = qty;

     // Initialize payable
    updatePayable(discPrice, qty);

    // Listen for quantity changes
    let qtyInput = document.getElementById('stock_quantity');
    qtyInput.addEventListener('input', function() {
        let newQty = parseInt(this.value) || 1;
        updatePayable(discPrice, newQty);
    });

    document.querySelectorAll('.product-images').forEach(el => {
        el.classList.add('d-none');
    });

    let activeImages = document.getElementById('product-images-' + productId);
    if (activeImages) {
        activeImages.classList.remove('d-none');
    }
    
        let rawSpecs = option.getAttribute('data-specifications') || '';

        let textarea = document.createElement('textarea');
        textarea.innerHTML = rawSpecs;

        document.getElementById('productSpecifications').innerHTML = textarea.value;


  
        let variations = JSON.parse(option.getAttribute('data-variations') || '[]');
        let container = document.getElementById('variationContainer');
        let descContainer = document.getElementById('productVariationsDesc');
         descContainer.innerHTML = '';

         container.innerHTML = '';

         let grouped = {};

        variations.forEach(v => {
            let type = v.variation_type?.name;
            let value = v.variation_value?.name;

            if (!type || !value) return;

            if (!grouped[type]) grouped[type] = [];
            if (!grouped[type].includes(value)) grouped[type].push(value);
        });

        Object.keys(grouped).forEach(type => {
            container.innerHTML += `
                <div class="row mb-2 border-bottom">
                    <div class="col-md-3">
                        <label class="form-label pt-2 text-dark">${type}</label>
                    </div>
                    <div class="col-md-8 ms-2">
                        <select class="form-select">
                            <option value="">-- Select ${type} --</option>
                            ${grouped[type].map(v => `<option>${v}</option>`).join('')}
                        </select>
                    </div>
                </div>
            `;
        });

        /* -------- SHOW VARIATIONS BELOW DESCRIPTION -------- */
            if (Object.keys(grouped).length > 0) {

                let html = '<ul class="description-list">';

                Object.entries(grouped).forEach(([type, values]) => {
                    html += `
                        <li>
                            ${type}:
                            <span>${values.join(', ')}</span>
                        </li>
                    `;
                });

                html += '</ul>';

                descContainer.innerHTML = html;
            }

            renderDynamicCharges(option);

}



    let activeCharges = {}; // store selected charges

    function renderDynamicCharges(option) {

        let charges = JSON.parse(option.getAttribute('data-charge_details') || '[]');
        let container = document.getElementById('dynamicChargeSection');

        container.innerHTML = '';
        activeCharges = {}; // reset

        charges.forEach((item, index) => {

            let title = item.name.replace(/_/g, ' ').toUpperCase();
            let charge = parseFloat(item.charge) || 0;
            let key = item.name;

            container.innerHTML += `
                <h6 class="text-base ps-2 border-top pt-1 fs-6">${title}</h6>

                <div class="row px-2 mb-2">
                    <div class="col-md-6 d-flex flex-column">
                        <div>
                            <input type="radio" name="${key}" id="${key}_required">
                            <label for="${key}_required" class="fw-semibold small">Required</label>
                        </div>

                        <div id="${key}_charge" class="d-none small mt-1 text-danger">
                            <small>(Extra Charges - Rs.${charge.toFixed(2)})</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <input type="radio" name="${key}" id="${key}_not_required" checked>
                        <label for="${key}_not_required" class="fw-semibold small">Not Required</label>
                    </div>
                </div>
            `;

            // attach event listener
            $(document).on('change', `input[name="${key}"]`, function () {

                let select = document.getElementById('productSelect');
                let opt = select.options[select.selectedIndex];

                let price = parseFloat(opt.getAttribute('data-disc_price')) || 0;
                let qty = parseInt($('#stock_quantity').val()) || 1;

                if (this.id === `${key}_required`) {
                    $(`#${key}_charge`).removeClass('d-none');
                    activeCharges[key] = charge;
                } else {
                    $(`#${key}_charge`).addClass('d-none');
                    delete activeCharges[key];
                }

                updatePayable(price, qty);
            });
        });
    }



    function updatePayable(price, quantity) {

        let cost = price * quantity;

        let extraChargeTotal = Object.values(activeCharges)
            .reduce((sum, val) => sum + val, 0);

        let subtotal = cost + extraChargeTotal;
        let gst = subtotal * 0.18;
        let payable = subtotal + gst;

        $('#disc_price').text(`Rs. ${cost.toFixed(2)}/-`);
        $('#gst_amount').text(`Rs. ${gst.toFixed(2)}/-`);
        $('#amount_payable').text(`Rs. ${payable.toFixed(2)}/-`);
    }

     



        $(document).ready(function () {
        $('input[name="file_option"]').on('change', function () {
            $('#online_info, #email_info').addClass('d-none');

            if (this.id === 'file_online') {
            $('#online_info').removeClass('d-none');
            } else if (this.id === 'file_email') {
            $('#email_info').removeClass('d-none');
            }
        });
        });


        function getStates(countryId, selectedStateId = null, stateSelectId = '#state') {
            const $stateSelect = $(stateSelectId);

            $stateSelect.empty();
            $stateSelect.html('<option disabled selected>Loading...</option>');
            $stateSelect.trigger('change');
            const isSelectedValid = selectedStateId !== null && selectedStateId !== undefined && selectedStateId !== '';

            $.ajax({
                url: "{{ route('get-states', ':id') }}".replace(':id', countryId),
                method: 'GET',
                success: function(data) {

                    $stateSelect.empty();

                    if (!isSelectedValid) {
                        $stateSelect.append('<option disabled selected>Select State</option>');
                    }

                    data.forEach(function(state) {
                        const isSelected = isSelectedValid && state.id == selectedStateId;
                        const option = new Option(state.name, state.id, isSelected, isSelected);
                        $stateSelect.append(option);
                    });

                   $stateSelect.trigger('change.select2');

                },
                error: function(xhr, status, error) {
                    $stateSelect.empty();
                    $stateSelect.trigger('change');
                }
            });
        }


        function getCities(stateId, selectedCityId = null, citySelectId = '#city') {
            const $citySelect = $(citySelectId);

            $citySelect.empty();
            $citySelect.html('<option disabled selected>Loading...</option>');
            $citySelect.trigger('change');
            const isSelectedValid = selectedCityId !== null && selectedCityId !== undefined && selectedCityId !== '';

            $.ajax({
                url: "{{ route('get-cities', ':id') }}".replace(':id', stateId),
                method: 'GET',
                success: function(data) {
                    $citySelect.empty();

                    if (!isSelectedValid) {
                        $citySelect.append('<option disabled selected>Select City</option>');
                    }

                    data.forEach(function(city) {
                      const isSelected = isSelectedValid && city.id == selectedCityId;
                        const option = new Option(city.name, city.id, isSelected, isSelected);
                        $citySelect.append(option);
                    });
                   $citySelect.trigger('change.select2');

                },
                error: function(xhr, status, error) {
                    $citySelect.empty();
                    $citySelect.trigger('change');
                }
            });
        }

         $('#country').on('change', function () {
            getStates(this.value);
        });

        $('#state').on('change', function () {
            getCities(this.value);
        });





$('.single-select').each(function () {
    $(this).select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: $(this).data('placeholder') || 'Select option',
        allowClear: true
    });
});

</script>
@endpush