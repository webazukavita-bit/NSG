@extends('admin.layouts.app')

@section('content')

    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div class="card-title d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file me-1 font-22 text-primary"></i>
                    <h5 class="mb-0 text-primary">Add Order</h5>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class=" shadow-sm">
                        <div class="body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="mb-3">
                                        <h6 class="form-label text-primary">ORDER NAME<code>*</code></h6>
                                        <input type="text" name="order_name" class="form-control @error('order_name') is-invalid @enderror" placeholder="" required>
                                        @error('order_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                     </div> --}}
                                <div class="mb-3">
                                    <h6 class="form-label text-primary">SELECT PRODUCT<code>*</code></h6>
                                    <select name="category_id" id="productSelect" class="form-select @error('category_id') is-invalid @enderror" onchange="productDetails()" required>
                                        <option value="" selected disabled>-- Choose Product --</option>
                                        <option value="{{ $product->id }}"
                                        data-variations='@json($product->variations)'
                                        data-disc_price="{{$product->disc_price}}"
                                        data-quantity="{{$product->stock_quantity}}">
                                         {{ $product->name }}   @foreach ($product->variations as $variation)
                                          {{$variation->variationType->name?' + '.$variation->variationType->name:''}} @endforeach
                                        </option>  
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="productFields" style="display:none;" class="border rounded">

                                    <h6 class="text-primary ps-2 border-bottom">SELECT DETAIL</h6>
                                        <div class="row mb-3 align-items-center ps-2">
                                            <div class="col-md-2">
                                                <label class="form-label text-dark pt-2">Quantity</label>
                                            </div>
                                            <div class="col-md-4 ms-3">
                                                <input type="number" name="quantity" id="stock_quantity" class="form-control" step="1">
                                            </div>

                                            <div class="col-md-4 pt-2 text-muted">
                                                (Min Qty : <span id="minQty">500</span>)
                                            </div>
                                        </div>

                                   <div class="row px-2" id="variationContainer"></div>
                                    <h6 class="text-primary border-top ps-2 pt-1">SELECT FILE OPTION</h6>

                                    <div class="row px-2">
                                        <div class="col-md-6">
                                            <input class="" type="radio" name="file_option" id="file_online">
                                            <label class="  fw-semibold" for="file_online">
                                                Attach file Online
                                            </label>

                                            <!-- Attach Online Info -->
                                            <div id="online_info" class="d-none">
                                                <p class="mb-0" style="font-size:10px">
                                                (Allowed File:96x58 mm, 30.00 MB, PDF Only)
                                                </p>
                                                <button class="btn btn-primary rounded-pill btn-sm">
                                                    more info
                                                </button>
                                            </div>
                                            </div>

                                        <div class="col-md-6">
                                            <input class="" type="radio" name="file_option" id="file_email">
                                            <label class=" fw-semibold" for="file_email">
                                                Send file via Email
                                            </label>

                                            <!-- Email Info -->
                                            <div id="email_info" class="d-none">
                                                <p class="text-danger mb-0" style="font-size:10px">
                                                (Extra Charges - Rs.20.00 is applicable)
                                                </p>
                                              
                                                <button class="btn btn-danger rounded-pill btn-sm">
                                                    more info
                                                </button>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-primary ps-2 border-top pt-1">PRIVACY PACKING</h6>

                                    <div class="row px-2">
                                        <div class="col-md-6">
                                            <input type="radio" name="privacy" id="required">
                                            <label for="required" class=" fw-semibold">Required</label>
                                            <div id="required_charge" class="d-none">
                                                <small class="text-danger" style="font-size:10px">
                                                (Extra Charges -Rs.5.00 is applicable)
                                                </small>
                                                <div class="mt-1">
                                                    <button class="btn btn-danger rounded-pill btn-sm">
                                                       more info
                                                     </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="radio" name="privacy" id="not_required">
                                            <label for="not_required" class=" fw-semibold">Not Required</label>
                                        </div>
                                    </div>
                                   <!-- COST SECTION -->
                                    <div class="px-2">
                                       <h6 class="text-primary py-2 border-top">Congratulations! Order's eligible for free delivery</h6>

                                        <div class="row py-2 border-top">
                                            <div class="col-6">Cost</div>
                                            <div class="col-6 text-end" id="disc_price"></div>
                                        </div>
                                
                                        <div class="row py-2 border-top">
                                            <div class="col-6">GST (18.00%)</div>
                                            <div class="col-6 text-end">Rs. 0/-</div>
                                        </div>
                                
                                        <div class="row mb-3 border-top">
                                            <div class="col-6 fw-bold">Amount Payable</div>
                                            <div class="col-6 fw-bold text-end">Rs. 0/-</div>
                                        </div>
                                  
                                        <div class=" row py-1 border-top">
                                            <div class="col-4"> <label class="form-label">Special Remark (Optional)</label></div>
                                            <div class="col-8">                                            <textarea class="form-control" placeholder="remarks for order processing team..."></textarea></div>
                                        </div> 
                                            <div class="row border-top pt-2">
                                                <div  class="col-4 mb-0">
                                                    <div>Enter Pressline :  
                                                        <p class="text-danger" style="font-size: 10px">To be Printed on Free Gift(Card Holder)</p>
                                                    </div>
                                                </div>
                                                    <div class="col-8 mb-0"> <input type="text" class="form-control text-muted" value="A PRINT MASTER"></div>
                                                    <button type="submit" class="btn btn-primary">
                                                            Add Order (Pay From Wallet)
                                                        </button>
                                            </div>
                                            
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                                <div class="col-md-5">
                                    <div id="productCard" style="display:none;">
                                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">

                                            <div class="carousel-indicators">
                                                @foreach($product->image as $index => $img)
                                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" 
                                                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                                            aria-label="Slide {{ $index + 1 }}"></button>
                                                @endforeach
                                            </div>

                                            <div class="carousel-inner">
                                                @foreach($product->image as $index => $img)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('images/product/' . $img) }}" 
                                                            class="d-block w-100 object-fit-cover" 
                                                            style="height:250px;" 
                                                            alt="Product Image">
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                        <div class="mt-3">
                                            <h5 class="text-primary text-decoration-underline" id="product_title">
                                                Product Description
                                            </h5>
                                            <div id="product_des">
                                                {!! $product->specifications !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>







            </div>

  
        </div>
    </div>
@endsection

@push('scripts')
<script>
function productDetails() {
    var select = document.getElementById('productSelect');
    var selectedOption = select.options[select.selectedIndex];

    var productFields = document.getElementById('productFields');
    var infoCard = document.getElementById('productCard');

    if (!select.value) {
        productFields.style.display = 'none';
        infoCard.style.display = 'none';
        return;
    }

    productFields.style.display = 'block';
    infoCard.style.display = 'block';
    document.getElementById('disc_price').innerHTML = selectedOption.getAttribute('data-disc_price');

    let stockQty = selectedOption.getAttribute('data-quantity');
    document.getElementById('stock_quantity').value = stockQty;
    document.getElementById('minQty').innerText = stockQty;

    

    // get variations
    let variations = JSON.parse(selectedOption.getAttribute('data-variations'));

    // container
    let container = document.getElementById("variationContainer");
    container.innerHTML = ""; 
     
    
    // group by type → include FULL values, not selected
    let grouped = {};

    variations.forEach(v => {
        let type = v.variation_type.name;

        // create group if empty
        if (!grouped[type]) grouped[type] = {
            selected: v.variation_value.name,     // currently selected value
            values: v.all_values.map(val => val.name) // FULL list
        };
    });

    // generate HTML
    Object.keys(grouped).forEach(type => {
        let sel = grouped[type].selected;
        let values = grouped[type].values;

        let html = `
            <div class="row mb-3">
               <div class="col-md-2">
                   <label class="form-label pt-2 text-dark">${type}</label>
                </div>
                <div class="col-md-9 ms-3">
                    <select class="form-select bg-light" name="variation[${type}]">
                        <option value="">--Select--</option>
                        ${values.map(v => 
                            `<option value="${v}" ${v === sel ? 'selected' : ''}>${v}</option>`
                        ).join('')}
                    </select>
               </div>
            </div>
        `;

        container.innerHTML += html;
    });
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

  $('input[name="privacy"]').on('change', function () {
    $('#required_charge').addClass('d-none');

     if (this.id === 'required') {
      $('#required_charge').removeClass('d-none');
    } 
  });


});

</script>
@endpush