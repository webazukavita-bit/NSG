@extends('front.layouts.app')
@section('content')


<style>
    .input-group-sm .btn {
        padding: 0.25rem 0.75rem;
        font-size: 1rem;
        line-height: 1.4;
    }
    .input-group-sm input {
        max-width: 90px;
    }
</style>


@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url({{asset('front/assets/img/breadcrumb.png')}});">
    <div class="container">
        <div class="page-heading">
            <div class="breadcrumb-sub-title text-center">
                <h1 class="wow fadeInUp" data-wow-delay=".3s">Shop Details</h1>
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><i class="fal fa-minus"></i></li>
                    <li>Shop Details</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Shop Details Section Start -->
<section class="shop-details-section section-padding pt-2">
    <div class="container">
        <div class="shop-details-wrapper" style="min-height: 1200px;">
            <form id="orderForm" action="{{route('ordere-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <label class="form-label text-base fw-semibold">
                            SELECT PRODUCT <code>*</code>
                        </label>
                        <select name="product_id" id="productSelect" class="form-control text-center py-2 bg-light" onchange="productDetails(this.value)" required>
                            <option value="" selected disabled>-- Choose Product --</option>
                            @foreach ($product as $pro)
                            <option value="{{ $pro->id }}" @selected(optional($selectedProduct)->id == $pro->id)>
                                {{ $pro->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="invalid-feedback text-center d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row" id="productFields" @if(!$selectedProduct) style="display: none" @endif>
                    <div class="col-lg-7">
                        <div class="product-details-content ms-0">
                            <h2 class="pb-2" id="product_name">{{ $selectedProduct->name ?? '' }}</h2>


                            <div class="d-flex gap-4 align-items-center mb-3">
                                <div>
                                    <strong class="text-dark">SKU:</strong>
                                    <span id="product_sku">{{ $selectedProduct->sku ?? '' }}</span>
                                </div>
                                <div>
                                    <strong class="text-dark">Categories:</strong>
                                    <span id="product_category">{{ $selectedProduct->category->name ?? '' }}</span>
                                </div>
                            </div>


                            {{-- Product Details --}}
                            <div id="productStep">
                                <div class="card border-rounded p-2">
                                    @if($selectedProduct && ($selectedProduct->variations??[])->count() > 0)
                                    <h6 class="text-base ps-2 border-bottom fs-6 py-1">SELECT DETAIL</h6>
                                    <div class="row px-2 pt-1" id="variationContainer">
                                        @php
                                            $grouped = [];
                                            foreach ($selectedProduct->variations??[] as $v) {
                                                if (!$v->variationType || !$v->variationValue) continue;
                                                $type = $v->variationType->name;
                                                $value = $v->variationValue->name;
                                                $grouped[$type][] = $value;
                                            }
                                        @endphp
                                        @foreach ($grouped as $type => $values)
                                        <div class="row mb-2 border-bottom">
                                            <div class="col-md-3">
                                                <label class="form-label pt-2 text-dark" for="variation_{{ str_replace(' ', '_', $type) }}{{ $selectedProduct->id }}">
                                                    {{ $type }}<code>*</code>
                                                </label>
                                            </div>
                                            <div class="col-md-8 ms-2">
                                                <select name="variations['{{ str_replace(' ', '_', $type) }}']"
                                                        id="variation_{{ str_replace(' ', '_', $type) }}{{ $selectedProduct->id }}"
                                                        class="form-control" required>
                                                    <option value="">-- Select {{ $type }} --</option>
                                                    @foreach (array_unique($values) as $val)
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif


                                    <h6 class="text-base border-top ps-2 pt-1 fs-6">SELECT FILE OPTION</h6>
                                    <div class="row px-2 mb-2">
                                        <div class="col-md-6 d-flex flex-column">
                                            <div>
                                                <input type="radio" name="file_option" id="file_online" value="online">
                                                <label class="fw-semibold small" for="file_online">Attach file Online</label>
                                            </div>
                                            <div id="online_info" class="small mt-1" style="display: none;">
                                                <p class="mb-0" style="font-size: 10px">(Allowed File: PDF Only)</p>
                                                <input type="file" name="file" class="form-control form-control-sm" accept=".pdf">
                                                <small class="text-info mt-1 d-block"><em>Maximum file size: 10 MB</em></small>
                                                <div id="file_size_info" class="small text-danger mt-1" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column">
                                            <div>
                                                <input type="radio" name="file_option" id="file_email" value="email">
                                                <label class="fw-semibold small" for="file_email">Send file via Email</label>
                                            </div>
                                            <div id="email_info" class="small mt-1 text-danger" style="display: none;">
                                                <p class="mb-0"></p>
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill">more info</button>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ✅ FIXED: Dynamic Charges --}}
                                    <div id="dynamicChargeSection"></div>


                                    <!-- COST SECTION -->
                                    <div class="px-2">
                                        <h6 class="text-base py-1 border-top">Congratulations! Order's eligible for free delivery</h6>
                                        <div class="row mb-2 align-items-center ps-2">
                                            <div class="col-md-2">
                                                <label class="form-label text-dark pt-1 small">Quantity</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group input-group-sm shadow-sm rounded">
                                                    {{-- ✅ FIXED: Quantity buttons --}}
                                                    <button class="btn btn-outline-danger fw-bold" type="button" onclick="updateQuantity('decrease')">
                                                        −
                                                    </button>
                                                    <input type="number" name="quantity" id="maxQty" class="form-control text-center fw-semibold" value="1" min="1" max="100">
                                                    <button class="btn btn-outline-primary fw-bold" type="button" onclick="updateQuantity('increase')">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pt-1 text-muted small">
                                                (Min Qty : <span id="minQty">1</span>)
                                            </div>
                                        </div>


                                        <div class="row py-1 border-top">
                                            <div class="col-6 small"><strong>Product Price</strong></div>
                                            <div class="col-6 text-end small" id="base_cost">Rs. 0/-</div>
                                        </div>


                                        <div id="extra_cost_row" class="row py-1 border-top d-none">
                                            <div class="col-6 small"><strong>Extra Charges</strong></div>
                                            <div class="col-6 text-end small" id="extra_cost">Rs. 0/-</div>
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
                                                <textarea class="form-control form-control-sm" name="remarks" placeholder="remarks for order processing team..." maxlength="500"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- ✅ FIXED: User details with proper country-state-city --}}
                            <div id="userStep" class="border rounded p-2 shadow-sm mt-3">
                                <h3 class="mb-2 text-base text-dark">User Details</h3>
                                <div class="row g-3">
                                    <div class="col-md-6 border-top mb-2 pt-2">
                                        <label class="form-label text-dark">Full Name <strong class="text-danger">*</strong></label>
                                        <input type="text" name="name" class="form-control" required value="{{Auth::user()->name}}">
                                    </div>


                                    <div class="col-md-6 border-top mb-2 pt-2">
                                        <label class="form-label text-dark">Phone <strong class="text-danger">*</strong></label>
                                        <input type="text" name="phone" class="form-control" required value="{{Auth::user()->phone_number}}">
                                    </div>


                                    <div class="col-md-6 border-top mb-2 pt-2">
                                        <label class="form-label text-dark">Email <strong class="text-danger">*</strong></label>
                                        <input type="email" name="email" class="form-control" readonly value="{{Auth::user()->email}}">
                                    </div>


                                    {{-- ✅ FIXED: Country dropdown --}}
                                    <div class="col-md-6 mb-3 border-top">
                                        <label for="country" class="form-label">Country<code>*</code></label>
                                        <select name="country" class="single-select @error('country') is-invalid @enderror" id="country" required>
                                            <option value="">Select Country...</option>
                                            @foreach ($countrie as $country)
                                            <option value="{{ $country->id }}"
                                                    {{ old('country', Auth::user()->address->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error-country"></small>
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    {{-- ✅ FIXED: State dropdown --}}
                                    <div class="col-md-6 mb-3 border-top">
                                        <label for="state" class="form-label">State<code>*</code></label>
                                        <select name="state" class="single-select @error('state') is-invalid @enderror" id="state" required>
                                            <option value="">Choose State...</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                    {{ old('state', Auth::user()->address->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error-state"></small>
                                        @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    {{-- ✅ FIXED: City dropdown --}}
                                    <div class="col-md-6 mb-3 border-top">
                                        <label for="city" class="form-label">City<code>*</code></label>
                                        <select name="city" class="single-select @error('city') is-invalid @enderror" id="city" required>
                                            <option value="">Choose City...</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                    {{ old('city', Auth::user()->address->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error-city"></small>
                                        @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-lg-6 border-top mb-2 pt-2">
                                        <label class="form-label text-dark">Address <strong class="text-danger">*</strong></label>
                                        <textarea name="address" class="form-control" rows="1" required>{{Auth::user()->address->address ?? ''}}</textarea>
                                    </div>


                                    <div class="col-lg-6 border-top mb-2 pt-2">
                                        <label class="form-label text-dark">Zip Code <strong class="text-danger">*</strong></label>
                                        <input type="text" name="zipcode" class="form-control" required value="{{Auth::user()->address->zip ?? ''}}">
                                        <small class="text-danger error-zipcode"></small>
                                    </div>
                                   
                                    <div class="text-danger fw-bold mb-2 error-wallet"></div>
                                    <div class="col-md-12 mt-2 d-flex gap-2">
                                        <button type="button" class="btn theme-btn" id="submitBtn" onclick="submitOrder()">
                                            Place Order With Wallet
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Product Images --}}
                    <div class="col-lg-5">
                        @foreach ($product as $pro)
                        <div class="shop-details-image product-images d-none" id="product-images-{{ $pro->id }}">
                            <div class="tab-content">
                                @foreach ($pro->image as $key => $img)
                                <div id="thumb{{ $pro->id }}{{ $key + 1 }}" class="tab-pane {{ $key == 0 ? 'active show' : '' }} fade" role="tabpanel">
                                    <div class="shop-thumb">
                                        <img src="{{ asset('images/product/'.$img) }}" alt="img">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <ul class="nav mb-5" role="tablist">
                                @foreach ($pro->image as $key => $img)
                                <li class="nav-item" role="presentation">
                                    <a href="#thumb{{ $pro->id }}{{ $key + 1 }}" data-bs-toggle="tab" class="nav-link ps-0 {{ $key == 0 ? 'active' : '' }}" aria-selected="false" role="tab" tabindex="-1">
                                        <img src="{{ asset('images/product/'.$img) }}" alt="img">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach


                        <div class="single-tab pt-2">
                            <div class="tab-content">
                                <div id="description" class="tab-pane fade show active">
                                    <div class="description-items">
                                        <div class="description-content">
                                            <h3>Product descriptions</h3>
                                            @if($selectedProduct && sizeof($selectedProduct->image) > 0)
                                            <img src="{{ asset('images/product/'.$selectedProduct->image[0]) }}" alt="Product" class="img-fluid mb-3" style="max-width: 300px;">
                                            @endif
                                            <p class="mb-2">{{ $selectedProduct->description ?? 'No description available' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="requiredPopup" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Incomplete Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Please fill all required fields before placing the order.
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="walletPopup" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="walletModalHeader">
                <h5 class="modal-title" id="walletModalTitle">Insufficient Wallet Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="walletModalBody">
                <p>Your wallet balance is insufficient to proceed with this purchase.</p>
            </div>
            <div class="modal-footer" id="walletModalFooter">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

</section>




@endsection


@push('scripts')
<script>
    let USER_WALLET_BALANCE = {{ Auth::user()->wallet->main_balance ?? 0 }};
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        allowClear: false,
        placeholder: "Select..."
    });
});
let CURRENT_MIN_QTY = 1;
let CURRENT_PRICE = {{ $selectedProduct->disc_price ?? 0 }};
let PRODUCT_ID = {{ $selectedProduct->id ?? 0 }};
let ACTIVE_CHARGES = {};


// ✅ FIXED: Quantity buttons
function updateQuantity(action) {
    let qtyEl = document.getElementById('maxQty');
    let qty = parseInt(qtyEl.value) || 1;
   
    if (action === 'decrease') {
        qty = Math.max(1, Math.floor(qty / 2));
    } else {
        qty = Math.min(100, qty * 2); // Max 100
    }
   
    qtyEl.value = qty;
    updatePayable();
}


// ---------- PAYABLE CALC ----------
function updatePayable() {
    let qty = parseInt($('#maxQty').val()) || 1;
    if (qty < 1) {
        qty = 1;
        $('#maxQty').val(1);
    }


    let baseCost = CURRENT_PRICE * qty;
    let extraChargesTotal = Object.values(ACTIVE_CHARGES).reduce((sum, val) => sum + (val * qty), 0);
    let subTotal = baseCost + extraChargesTotal;
    let gst = subTotal * 0.18;
    let payable = subTotal + gst;


    // Display breakdown
    $('#base_cost').text(`Rs. ${baseCost.toFixed(2)}/-`);
   
    if (extraChargesTotal > 0) {
        $('#extra_cost_row').removeClass('d-none');
        $('#extra_cost').text(`Rs. ${extraChargesTotal.toFixed(2)}/-`);
    } else {
        $('#extra_cost_row').addClass('d-none');
    }
   
    $('#gst_amount').text(`Rs. ${gst.toFixed(2)}/-`);
    $('#amount_payable').text(`Rs. ${payable.toFixed(2)}/-`);
}


// ---------- DYNAMIC CHARGES ----------
function renderDynamicCharges(charges = []) {
    let container = $('#dynamicChargeSection');
    container.html('');
    ACTIVE_CHARGES = {};


    charges.forEach(item => {
        let key = item.name;
        let charge = parseFloat(item.charge) || 0;


        container.append(`
            <h6 class="text-base ps-2 border-top pt-1 fs-6">${key.replaceAll('_',' ')}</h6>
            <div class="row px-2 mb-2">
                <div class="col-md-6">
                    <input type="radio" name="${key}" value="yes">
                    <label class="small fw-semibold">Required</label>
                    <div class="small text-danger d-none" id="${key}_price">
                        Extra Charges : Rs.${charge} per unit
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="radio" name="${key}" value="no" checked>
                    <label class="small fw-semibold">Not Required</label>
                </div>
            </div>
        `);


        $(document).on('change', `input[name="${key}"]`, function () {
            if (this.value === 'yes') {
                ACTIVE_CHARGES[key] = charge;
                $(`#${key}_price`).removeClass('d-none');
            } else {
                delete ACTIVE_CHARGES[key];
                $(`#${key}_price`).addClass('d-none');
            }
            updatePayable();
        });
    });
}


// ---------- ✅ FIXED: Country/State/City AJAX Functions ----------
function getStates(countryId, selectedStateId = null, stateSelectId = '#state') {
    const $stateSelect = $(stateSelectId);


    $stateSelect.empty().append('<option value="">Loading...</option>').prop('disabled', true);
    $stateSelect.trigger('change');


    $.ajax({
        url: "{{ route('get-states', ':id') }}".replace(':id', countryId),
        method: 'GET',
        success: function(data) {
            $stateSelect.empty().prop('disabled', false);
            $stateSelect.append('<option value="">Choose State...</option>');


            data.forEach(function(state) {
                const isSelected = selectedStateId && state.id == selectedStateId;
                const option = new Option(state.name, state.id, isSelected, isSelected);
                $stateSelect.append(option);
            });


            $stateSelect.trigger('change.select2');
        },
        error: function() {
            $stateSelect.empty().append('<option value="">Error loading states</option>');
            $stateSelect.trigger('change');
        }
    });
}

function showWalletModal(payableAmount) {
    $('#walletModalHeader').removeClass('bg-warning bg-danger').addClass('bg-warning');
    $('#walletModalTitle').text('Insufficient Wallet Balance');
    $('#walletModalBody').html('<p>Your wallet balance is insufficient.</p><p><strong>Wallet:</strong> Rs. ' + USER_WALLET_BALANCE.toFixed(2) + '</p><p><strong>Payable:</strong> Rs. ' + payableAmount.toFixed(2) + '</p>');
    $('#walletModalFooter').html('<a href="{{ route('fund-add') }}" class="btn btn-success">Add Money</a>');
    $('#walletPopup').modal('show');
}

function showErrorModal(msg) {
    $('#walletModalHeader').removeClass('bg-warning bg-danger').addClass('bg-danger');
    $('#walletModalTitle').text('Error');
    $('#walletModalBody').html('<p>' + msg + '</p>');
    $('#walletModalFooter').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
    $('#walletPopup').modal('show');
}

function submitOrder() {
    // Validate required fields
    let requiredFields = ['name','phone','email','country','state','city','address','zipcode'];
    for (let field of requiredFields) {
        if (!$(`[name="${field}"]`).val()) {
            showErrorModal('Please fill all required fields.');
            return;
        }
    }

    // Validate quantity
    let qty = parseInt($('#maxQty').val()) || 1;
    if (qty < 1 || qty > 100) {
        showErrorModal('Please enter quantity between 1-100');
        return;
    }

    // Validate file option
    let fileOption = $('input[name="file_option"]:checked').val();
    if (!fileOption) {
        showErrorModal('Please select file option');
        return;
    }

    if (fileOption === 'online') {
        let file = $('input[name="file"]')[0].files[0];
        if (!file) {
            showErrorModal('Please select PDF file for online option');
            return;
        }
        if (file.type !== 'application/pdf') {
            showErrorModal('Only PDF files allowed');
            return;
        }
    }

    // Validate variations
    let variationSelects = $('#variationContainer select');
    if (variationSelects.length > 0) {
        let allSelected = true;
        variationSelects.each(function() {
            if (!$(this).val()) {
                allSelected = false;
                return false;
            }
        });
        if (!allSelected) {
            showErrorModal('Please select all variations');
            return;
        }
    }

    // Validate wallet balance
    let payableText = $('#amount_payable').text().replace(/[^\d.]/g, '');
    let payableAmount = parseFloat(payableText) || 0;

    if (payableAmount == 0) {
        showErrorModal('Please select a product with valid price');
        return;
    }

    if (USER_WALLET_BALANCE < payableAmount) {
        showWalletModal(payableAmount);
        return;
    }

    // Submit form
    let formData = new FormData($('#orderForm')[0]);

    $.ajax({
        url: $('#orderForm').attr('action'),
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...');
        },
        success: function(res) {
            let successHtml = `
                <div class="alert alert-success alert-dismissible fade show fixed-top-alert" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <div class="d-flex gap-2">
                        <span style="font-size: 24px; color: #28a745;">✓</span>
                        <div>
                            <strong>Order Placed Successfully!</strong><br>
                            <small>Redirecting to orders...</small>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(successHtml);
            setTimeout(() => {
                window.location.href = res.redirect || '/user/orders';
            }, 2000);
        },
        error: function(xhr) {
            $('#submitBtn').prop('disabled', false).html('Place Order With Wallet');
            let msg = xhr.responseJSON?.message || 'Add money to wallet to place order';
            showErrorModal(msg);
        }
    });
}


function getCities(stateId, selectedCityId = null, citySelectId = '#city') {
    const $citySelect = $(citySelectId);


    $citySelect.empty().append('<option value="">Loading...</option>').prop('disabled', true);
    $citySelect.trigger('change');


    $.ajax({
        url: "{{ route('get-cities', ':id') }}".replace(':id', stateId),
        method: 'GET',
        success: function(data) {
            $citySelect.empty().prop('disabled', false);
            $citySelect.append('<option value="">Choose City...</option>');


            data.forEach(function(city) {
                const isSelected = selectedCityId && city.id == selectedCityId;
                const option = new Option(city.name, city.id, isSelected, isSelected);
                $citySelect.append(option);
            });


            $citySelect.trigger('change.select2');
        },
        error: function() {
            $citySelect.empty().append('<option value="">Error loading cities</option>');
            $citySelect.trigger('change');
        }
    });
}


// ---------- INITIAL LOAD ----------
$(document).ready(function () {
    // Initialize Select2
   


    // ✅ FIXED: Preload user's saved address
    let savedCountryId = "{{ Auth::user()->address->country_id ?? '' }}";
    let savedStateId = "{{ Auth::user()->address->state_id ?? '' }}";
    let savedCityId = "{{ Auth::user()->address->city_id ?? '' }}";


    if (savedCountryId) {
        // Load states for saved country and select saved state
        getStates(savedCountryId, savedStateId);
       
        // If user has saved state, load cities too
        if (savedStateId && savedCityId) {
            getCities(savedStateId, savedCityId);
        }
    }


    // Show product fields if selected
    @if($selectedProduct)
        $('#productFields').show();
        $('#product_name').text('{{ $selectedProduct->name }}');
        $('#product_sku').text('{{ $selectedProduct->sku ?? "" }}');
        $('#product_category').text('{{ $selectedProduct->category->name ?? "" }}');
        $('#product-images-{{ $selectedProduct->id }}').removeClass('d-none');
       
        renderDynamicCharges(@json($selectedProduct->charge_details ?? []));
        updatePayable();
    @else
        $('#productFields').hide();
    @endif


    // Quantity input change
    $('#maxQty').on('input', updatePayable);


    // ✅ FIXED: Country/State/City change handlers
    $('#country').on('change', function() {
        if (this.value) {
            getStates(this.value);
            $('#city').empty().append('<option value="">Choose City...</option>').trigger('change');
        } else {
            $('#state, #city').empty().append('<option value="">Choose State...</option>').trigger('change');
        }
    });


    $('#state').on('change', function() {
        if (this.value) {
            getCities(this.value);
        } else {
            $('#city').empty().append('<option value="">Choose City...</option>').trigger('change');
        }
    });


    // File option change
    $('input[name="file_option"]').on('change', function () {
        $('#online_info, #email_info').hide();
        if (this.id === 'file_online') {
            $('#online_info').show();
            $('input[name="file"]').prop('required', true);
        }
        if (this.id === 'file_email') {
            $('#email_info').show();
            $('input[name="file"]').prop('required', false);
        }
        updatePayable();
    });


    // File validation
    $('input[name="file"]').on('change', function () {
        let file = this.files[0];
        const maxFileSize = 10 * 1024 * 1024;
        let fileSizeError = $('#file_size_info');
       
        fileSizeError.html('').hide();
       
        if (!file) return;
       
        if (file.type !== 'application/pdf') {
            fileSizeError.html('❌ Only PDF files are allowed').show();
            this.value = '';
            return;
        }
       
        if (file.size > maxFileSize) {
            fileSizeError.html('❌ File size exceeds 10 MB limit. File size: ' + (file.size / (1024 * 1024)).toFixed(2) + ' MB').show();
            this.value = '';
            return;
        }
       
        fileSizeError.html('✓ File valid').removeClass('text-danger').addClass('text-success').show();
    });
});


// Form submit is handled by submitOrder() function triggered by button onclick


function productDetails(productId) {
    if (!productId) return;
    let slug = "{{ $product->first()->slug ?? '' }}";
    window.location.href = "{{ url('shop-details') }}/" + slug + "?pro=" + productId;
}
</script>
@endpush