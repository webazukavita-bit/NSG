<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ Cookie::get('theme_style', 'light-theme') }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/config/'.config('app.auth_logo')) }}">
    <!--plugins-->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/notifications/css/lobibox.min.css') }}" />
    <link href="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/header-colors.css') }}" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .invoice-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 40px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .invoice-header {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            color: rgb(20, 17, 17);
            padding: 40px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .company-logo {
            max-width: 150px;
            height: auto;
            background: white;
            padding: 10px;
            border-radius: 8px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .invoice-number {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .company-details {
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.95;
            margin-top: 20px;
        }

        .company-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .invoice-body {
            padding: 40px;
        }

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-block h3 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #667eea;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info-block h2 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .info-block p {
            color: #718096;
            line-height: 1.6;
            margin: 5px 0;
        }

        .invoice-details-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px 20px;
        }

        .detail-label {
            font-weight: 600;
            color: #4a5568;
        }

        .detail-value {
            color: #718096;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table thead {
            background: #f7fafc;
        }

        .items-table th {
            padding: 15px;
            text-align: left;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5568;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        .items-table th.text-right,
        .items-table td.text-right {
            text-align: right;
        }

        .items-table td.text-center {
            text-align: center;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .items-table tbody tr:hover {
            background: #f7fafc;
        }

        .items-table td {
            padding: 20px 15px;
            color: #4a5568;
        }

        .item-name {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .item-details {
            font-size: 0.85rem;
            color: #a0aec0;
            line-height: 1.5;
        }

        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .totals-table {
            width: 350px;
        }

        .totals-table tr {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .totals-table tr.grand-total {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin-top: 10px;
            border-radius: 6px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .totals-label {
            font-weight: 600;
            color: #4a5568;
        }

        .totals-value {
            font-weight: 600;
            color: #2d3748;
        }

        .grand-total .totals-label,
        .grand-total .totals-value {
            color: white;
        }

        .footer-section {
            background: #f7fafc;
            padding: 30px 40px;
            border-top: 2px solid #e2e8f0;
        }

        .thank-you {
            font-size: 1.5rem;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 20px;
        }

        .notice-box {
            background: #fff5e1;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .notice-title {
            font-weight: 600;
            color: #92400e;
            margin-bottom: 5px;
        }

        .notice-text {
            color: #78350f;
            font-size: 0.9rem;
        }

        .footer-text {
            text-align: center;
            color: #a0aec0;
            font-size: 0.85rem;
            margin-top: 20px;
        }

        .toolbar {
            padding: 20px 40px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-modern {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-print {
            background: #4a5568;
            color: white;
        }

        .btn-print:hover {
            background: #2d3748;
        }

        .btn-pdf {
            background: #dc2626;
            color: white;
        }

        .btn-pdf:hover {
            background: #b91c1c;
        }

        @media print {
            body {
                background: white;
            }
            .toolbar {
                display: none !important;
            }
            .invoice-container {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
            }
        }

        @media (max-width: 768px) {
            .info-section {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .header-top {
                flex-direction: column;
                gap: 20px;
            }

            .invoice-title {
                text-align: left;
            }

            .totals-table {
                width: 100%;
            }

            .items-table {
                font-size: 0.85rem;
            }

            .items-table th,
            .items-table td {
                padding: 10px 8px;
            }

            .invoice-body {
                padding: 20px;
            }
        }
        /* @media print {
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
} */
.print-area {
    position: relative;
}

@media print {
    .print-area::before {
        content: "New Select Graphix"; /* OR use logo image */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg);

        font-size: 60px;
        font-weight: bold;
        color: rgba(0, 0, 0, 0.08); /* light watermark */

        z-index: 0;
        pointer-events: none;
        white-space: nowrap;
    }

    .print-area * {
        position: relative;
        z-index: 1;
    }
}

    </style>
</head>

<body>
    <div class="invoice-container print-area">
        <div class="toolbar hidden-print">
            <button type="button" class="btn-modern btn-print" onclick="window.print()">
                <i class="fa fa-print"></i> Print
            </button>
         <button type="button" class="btn-modern btn-pdf" onclick="window.print()">
    <i class="fa fa-file-pdf-o"></i> Export as PDF
</button>

        </div>

        <div class="invoice-header">
            <div class="header-top">
                <div>
                    <img src="{{asset('images/config/'.config('app.logo'))}}" alt="Company Logo" class="company-logo">
                    <div class="company-details">
                        <div class="company-name">{{config('app.name')}}</div>
                        {{config('app.address')}}<br>
                        {{config('app.contact_us')}}<br>
                        {{config('app.email_account')}}
                    </div>
                </div>
                <div class="invoice-title">
                    <h1>INVOICE</h1>
                    <div class="invoice-number">#{{$order->id ?? ''}}</div>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="info-section">
                <div class="info-block">
                    <h3>Bill To</h3>
                    <h2>{{$order->user->name ?? ''}}</h2>
                    <p>
                        {{ $address['type'] ?? '' }}<br>
                        {{ $address['address'] ?? '' }},<br>
                        {{ $address['city'] ?? '' }}, {{ $address['state'] ?? '' }},<br>
                        {{ $address['country'] ?? '' }} - {{ $address['zip'] ?? '' }}
                    </p>
                    <p style="margin-top: 10px;">
                        <strong>Email:</strong> <a href="mailto:{{$user->email ?? ''}}">{{$user->email ?? ''}}</a>
                    </p>
                </div>

                <div class="info-block">
                    <h3>Invoice Details</h3>
                    <div class="invoice-details-grid">
                        <span class="detail-label">Invoice Date:</span>
                        <span class="detail-value">{{ now()->format('d M Y, h:i A') }}</span>
                        {{--                         
                        <span class="detail-label">Order Date:</span>
                        <span class="detail-value">{{ $order->created_at}}</span> --}}
                    </div>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Description</th>
                        <th class="text-right" style="width: 100px;">Price</th>
                        <th class="text-center" style="width: 80px;">Qty</th>
                        <th class="text-right" style="width: 100px;">Discount</th>
                        <th class="text-right" style="width: 120px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Check if $products is a single product or array of products
                        $productList = [];
                        
                        if (isset($products['product_id'])) {
                            // Single product - wrap in array
                            $productList = [$products];
                        } elseif (is_array($products) && isset($products[0])) {
                            // Already an array of products
                            $productList = $products;
                        }
                    @endphp
                    
                    @if(count($productList) > 0)
                        @foreach ($productList as $index => $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @php
                                        // Try to get product name from database if available
                                        $productModel = \App\Models\Product::find($product['product_id'] ?? null);
                                    @endphp
                                    
                                    <div class="item-name">{{ $productModel->name ?? 'Product #' . ($product['product_id'] ?? 'N/A') }}</div>
                                    <div class="item-details">
                                        @if(isset($product['variations']) && is_array($product['variations']))
                                            Variations: 
                                            @foreach($product['variations'] as $key => $value)
                                                {{ $key }}: {{ $value }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                            <br>
                                        @endif
                                        
                                        @if($productModel)
                                            SKU: {{ $productModel->sku ?? 'N/A' }} | Product: {{ $productModel->name ?? 'N/A' }}
                                        @endif
                                    </div>
                                </td>
                                <td class="text-right">₹{{ number_format($product['price'] ?? 0, 2) }}</td>
                                <td class="text-center">{{ $product['quantity'] ?? 1 }}</td>
                                <td class="text-right">₹{{ number_format($product['disc_price'] ?? 0, 2) }}</td>
                                <td class="text-right">
                                    ₹{{ number_format(($product['price'] ?? 0) * ($product['quantity'] ?? 1), 2) }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No product details available</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td class="totals-label">Subtotal</td>
                        <td class="totals-value text-right">₹{{ number_format($subTotal ?? 0, 2) }}</td>
                    </tr>
                    @if(isset($order['order_tax']) && $order['order_tax'] > 0)
                    <tr>
                        <td class="totals-label">Tax</td>
                        <td class="totals-value text-right">₹{{ number_format($order['order_tax'] ?? 0, 2) }}</td>
                    </tr>
                    @endif
                    
                    @if(isset($product['extra_charges']) && $product['extra_charges'] > 0)
                    <tr>
                        <td class="totals-label">Extra Charges</td>
                        <td class="totals-value text-right">₹{{ number_format($product['extra_charges'] ?? 0, 2) }} /quantity</td>
                    </tr>
                    @endif
                    
                    <tr class="grand-total">
                        <td class="totals-label">GRAND TOTAL</td>
                        <td class="totals-value text-right">
                            ₹{{ number_format(
                                ($subTotal ?? 0) + 
                                ($order['order_tax'] ?? 0) + 
                                ($product['extra_charges']*$product['quantity']  ?? 0), 
                            2) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer-section">
            <div class="thank-you">Thank You for Your Business!</div>
            
            <div class="notice-box">
                <div class="notice-title">Payment Terms & Conditions</div>
                <div class="notice-text">
                    A privacy charges is 5 rs.
                </div>
            </div>

            <div class="footer-text">
                Invoice was created on a computer and is valid without the signature and seal.
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    
    <!--notification js -->
    <script src="{{ asset('admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>

    <!--app JS-->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
    
    <script>
        @if (session('success'))
            Lobibox.notify('success', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-check-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: "{{ session('success') }}"
            });

        @elseif (session('error'))
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-x-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: "{{ session('error') }}"
            });

        @elseif (session('warning'))
            Lobibox.notify('warning', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-error',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: "{{ session('warning') }}"
            });

        @elseif (session('info'))
            Lobibox.notify('info', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-info-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: "{{ session('info') }}"
            });
        @endif


        $(function () {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })

        
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

                    $stateSelect.trigger('change');
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
                        const isSelected = isSelectedValid && state.id == selectedCityId;
                        const option = new Option(city.name, city.id, isSelected, isSelected);
                        $citySelect.append(option);
                    });
                    $citySelect.trigger('change');
                },
                error: function(xhr, status, error) {
                    $citySelect.empty();
                    $citySelect.trigger('change');
                }
            });
        }

        
        function setupImageUpload(inputId, cardId, previewId) {
            const input = document.getElementById(inputId);
            const card = document.getElementById(cardId);
            const preview = document.getElementById(previewId);

            card.addEventListener("click", () => input.click());
            preview.addEventListener("click", () => input.click());
            input.addEventListener("change", () => {
                let file = input.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = "block";
                    card.style.display = "none";
                }
            });
            preview.addEventListener("change", () => {
                let file = input.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = "block";
                    card.style.display = "none";
                }
            });
        }
        
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.querySelector('.btn-pdf').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text("Hello PDF", 10, 10);
    doc.save("document.pdf");
});
</script>


     
