<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Invoice</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 6mm;
        }
        body {
            margin: 0;
            padding: 10px;
            background: #f2f2f2;
            font-family: "Times New Roman", serif;
            color: #000;
            font-size: 11px;
        }
        .toolbar {
            width: 100%;
            max-width: 198mm;
            margin: 0 auto 8px auto;
            text-align: right;
        }
        .toolbar button {
            border: 1px solid #000;
            background: #fff;
            padding: 5px 12px;
            cursor: pointer;
            margin-left: 6px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .invoice-sheet {
            width: 100%;
            max-width: 198mm;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        td, th {
            border: 1px solid #000;
            padding: 2px 4px;
            vertical-align: top;
            word-wrap: break-word;
        }
        .no-border {
            border: 0 !important;
        }
        .inner-table td, .inner-table th {
            border: 1px solid #000;
            padding: 3px 5px;
        }
        .header-left {
            width: 20%;
            text-align: center;
        }
        .header-center {
            width: 55%;
            text-align: center;
        }
        .header-right {
            width: 25%;
            padding: 0;
        }
        .company-name {
            font-family: Arial, sans-serif;
            font-weight: 700;
            font-size: 22px;
            letter-spacing: 0.5px;
            line-height: 1;
        }
        .invoice-title {
            font-family: Arial, sans-serif;
            font-weight: 700;
            font-size: 18px;
            line-height: 1;
            margin-bottom: 2px;
        }
        .addr-line {
            font-size: 12px;
            line-height: 1.15;
        }
        .bold {
            font-weight: 700;
        }
        .small {
            font-size: 11px;
        }
        .items th {
            text-align: center;
            font-weight: 700;
            font-size: 10.5px;
        }
        .items td {
            font-size: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .empty-row td {
            height: 17px;
        }
        .totals td {
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .terms {
            font-size: 10.5px;
            line-height: 1.25;
        }
        .signature {
            text-align: right;
            padding-right: 16px;
            padding-top: 20px;
            font-size: 11px;
        }
        .logo-wrap img {
            max-width: 100%;
            max-height: 55px;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .toolbar {
                display: none !important;
            }
            .invoice-sheet {
                width: 100%;
                min-height: auto;
                margin: 0;
            }
        }
    </style>
</head>
<body>
@php
    if (!function_exists('invoice_number_to_words')) {
        function invoice_number_to_words($num) {
            $ones = [
                0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
                5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
                14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
                18 => 'Eighteen', 19 => 'Nineteen'
            ];
            $tens = [2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'];
            $num = (int) $num;
            if ($num === 0) {
                return 'Zero';
            }
            if ($num < 0) {
                return 'Minus ' . invoice_number_to_words(abs($num));
            }
            $words = '';
            if ($num >= 10000000) {
                $words .= invoice_number_to_words((int) ($num / 10000000)) . ' Crore ';
                $num %= 10000000;
            }
            if ($num >= 100000) {
                $words .= invoice_number_to_words((int) ($num / 100000)) . ' Lakh ';
                $num %= 100000;
            }
            if ($num >= 1000) {
                $words .= invoice_number_to_words((int) ($num / 1000)) . ' Thousand ';
                $num %= 1000;
            }
            if ($num >= 100) {
                $words .= $ones[(int) ($num / 100)] . ' Hundred ';
                $num %= 100;
            }
            if ($num >= 20) {
                $words .= $tens[(int) ($num / 10)] . ' ';
                $num %= 10;
            }
            if ($num > 0) {
                $words .= $ones[$num] . ' ';
            }
            return trim($words);
        }
    }

    $companyName = strtoupper($configuration->company_name ?? config('app.name', 'NEW SELECT GRAPHIX'));
    $companyAddress = $configuration->address ?? config('app.address', '');
    $companyPhone = $configuration->phone ?? config('app.contact_us', '');
    $companyEmail = $configuration->email ?? config('mail.from.address', '');
    $gstin = $configuration->gstin ?? '';
    $pan = $configuration->pan ?? '';
    $invoiceNo = data_get($order, 'invoice_no') ?? data_get($order, 'invoice_number') ?? ($order->id ?? '');
    $invoiceDate = !empty($order) ? \Carbon\Carbon::parse($order->getOriginal('created_at'))->format('d/M/Y') : now()->format('d/M/Y');
    $ewayNo = data_get($order, 'eway_no') ?? data_get($order, 'e_way_no') ?? '';
    $vehicleNo = data_get($order, 'vehicle_no') ?? data_get($order, 'vehicle_number') ?? '';

    $addressData = is_array($address ?? null) ? $address : [];
    $fallbackAddress = \App\Models\Address::with(['city', 'state'])
        ->where('user_id', data_get($order, 'user_id'))
        ->latest('id')
        ->first();

    $billingAddress = data_get($addressData, 'billing_address')
        ?? data_get($addressData, 'billing')
        ?? (isset($addressData['address']) ? $addressData : []);
    $shippingAddress = data_get($addressData, 'shipping_address')
        ?? data_get($addressData, 'shipping')
        ?? [];

    $productList = [];
    if (isset($products) && $products instanceof \Illuminate\Support\Collection) {
        $productList = $products->toArray();
    } elseif (isset($products['product_id'])) {
        $productList = [$products];
    } elseif (is_array($products ?? null) && isset($products[0])) {
        $productList = $products;
    }

    $cgstPercent = $cgstPercent ?? 9;
    $sgstPercent = $sgstPercent ?? 9;
    $subTotal = 0;
    foreach ($productList as $p) {
        $subTotal += ($p['price'] ?? 0) * ($p['quantity'] ?? 1);
    }
    $cgst = $cgst ?? ($subTotal * $cgstPercent / 100);
    $sgst = $sgst ?? ($subTotal * $sgstPercent / 100);
    $finalAmount = $finalAmount ?? ($subTotal + $cgst + $sgst);
    $amountInWords = invoice_number_to_words((int) round($finalAmount));

    $billName = strtoupper(trim((string) (
        data_get($billingAddress, 'contact_person_name')
        ?? data_get($billingAddress, 'name')
        ?? data_get($order, 'user.name')
        ?? data_get($order, 'customer.name')
        ?? ''
    )));
    $billAddress = strtoupper(trim((string) (
        (data_get($billingAddress, 'address') ?? data_get($fallbackAddress, 'address') ?? '') . ' ' .
        (data_get($billingAddress, 'street') ?? data_get($fallbackAddress, 'street') ?? '') . ' ' .
        (data_get($billingAddress, 'city') ?? data_get($fallbackAddress, 'city.name') ?? '') . ' ' .
        (data_get($billingAddress, 'state') ?? data_get($fallbackAddress, 'state.name') ?? '') . ' ' .
        (data_get($billingAddress, 'zip') ?? data_get($billingAddress, 'zipcode') ?? data_get($billingAddress, 'postal_code') ?? data_get($fallbackAddress, 'zip') ?? '')
    )));
    $billGstin = strtoupper(trim((string) (data_get($billingAddress, 'gstin') ?? data_get($order, 'billing_gstin') ?? $gstin)));

    $shipName = strtoupper(trim((string) (
        data_get($shippingAddress, 'contact_person_name')
        ?? data_get($shippingAddress, 'name')
        ?? $billName
    )));
    $shipAddress = strtoupper(trim((string) (
        (data_get($shippingAddress, 'address') ?? data_get($billingAddress, 'address') ?? data_get($fallbackAddress, 'address') ?? '') . ' ' .
        (data_get($shippingAddress, 'street') ?? data_get($billingAddress, 'street') ?? data_get($fallbackAddress, 'street') ?? '') . ' ' .
        (data_get($shippingAddress, 'city') ?? data_get($billingAddress, 'city') ?? data_get($fallbackAddress, 'city.name') ?? '') . ' ' .
        (data_get($shippingAddress, 'state') ?? data_get($billingAddress, 'state') ?? data_get($fallbackAddress, 'state.name') ?? '') . ' ' .
        (data_get($shippingAddress, 'zip') ?? data_get($shippingAddress, 'zipcode') ?? data_get($shippingAddress, 'postal_code') ?? data_get($billingAddress, 'zip') ?? data_get($fallbackAddress, 'zip') ?? '')
    )));

    $companyBankRecord = $companyBank ?? \App\Models\CompanyBank::with('bank')->latest('id')->first();
    $fallbackBankDetail = null;
    if (!$companyBankRecord) {
        $fallbackBankDetail = \App\Models\BankDetail::with('bank')
            ->where('status', 'Verified')
            ->latest('id')
            ->first();
    }
    $companyBankName = strtoupper(
        data_get($companyBankRecord, 'display_name')
        ?? data_get($companyBankRecord, 'bank.name')
        ?? data_get($fallbackBankDetail, 'bank.name')
        ?? 'BANK'
    );
    $companyAccountNo = data_get($companyBankRecord, 'account_no')
        ?? data_get($companyBankRecord, 'account_number')
        ?? data_get($fallbackBankDetail, 'account_number')
        ?? '';
    $companyIfsc = strtoupper(
        data_get($companyBankRecord, 'ifsc_code')
        ?? data_get($companyBankRecord, 'ifscode')
        ?? data_get($fallbackBankDetail, 'ifscode')
        ?? ''
    );
    $companyBranch = strtoupper(
        data_get($companyBankRecord, 'branch')
        ?? data_get($fallbackBankDetail, 'branch')
        ?? ''
    );
@endphp

<div class="toolbar">
    <button type="button" onclick="window.print()">Print</button>
    <button type="button" onclick="generatePDF()">Export PDF</button>
</div>

<div class="invoice-sheet">
    <table>
        <tr>
            <td class="header-left">
                <div class="logo-wrap">
                    <img src="{{ asset('images/config/'.config('app.logo')) }}" alt="{{ $companyName }}">
                </div>
            </td>
            <td class="header-center">
                <div class="invoice-title">{{ $companyName }}</div>
                <div class="addr-line">{{ $companyAddress }}</div>
                <div class="addr-line">Phone : {{ $companyPhone }}</div>
                <div class="addr-line">Email Id : {{ $companyEmail }}</div>
                <div class="addr-line bold">GST : {{ $gstin }} &nbsp;&nbsp; PAN : {{ $pan }}</div>
            </td>
            <td class="header-right">
                <table class="inner-table">
                    <tr>
                        <td class="bold">Invoice No.</td>
                        <td class="bold text-center">{{ $invoiceNo }}</td>
                    </tr>
                    <tr>
                        <td class="bold">Dated</td>
                        <td class="bold text-center">{{ $invoiceDate }}</td>
                    </tr>
                    <tr>
                        <td class="bold">Evay No.</td>
                        <td>{{ $ewayNo }}</td>
                    </tr>
                    <tr>
                        <td class="bold">Vehicle No.</td>
                        <td>{{ $vehicleNo }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width:50%;">
                <div class="small">Detail of Receiver (Billed To)</div>
                <div class="bold" style="font-size: 13px;">M/s {{ $billName ?: '-' }}</div>
                <div style="font-size: 11px; min-height: 28px;">{{ $billAddress ?: '-' }}</div>
                <div class="bold" style="font-size: 11px; margin-top: 4px;">GSTIN No. {{ $billGstin ?: '-' }}</div>
            </td>
            <td style="width:50%;">
                <div class="small">Detail of Consignee (Shipped To)</div>
                <div class="bold" style="font-size: 13px;">M/s {{ $shipName ?: '-' }}</div>
                <div style="font-size: 11px; min-height: 30px;">{{ $shipAddress ?: $billAddress ?: '-' }}</div>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
        <tr>
            <th style="width:4%;">S No</th>
            <th style="width:40%;">Particulars</th>
            <th style="width:7%;">Ch. No</th>
            <th style="width:11%;">Ch. Date</th>
            <th style="width:6%;">HSN/SAC</th>
            <th style="width:4%;">Tax</th>
            <th style="width:6%;">Qty</th>
            <th style="width:8%;">Rate</th>
            <th style="width:14%;">Amount</th>
        </tr>
        </thead>
        <tbody>
        @forelse($productList as $index => $product)
            @php
                $productName = data_get($product, 'name')
                    ?? data_get($product, 'product_name')
                    ?? data_get($product, 'title')
                    ?? data_get($product, 'product.name')
                    ?? ('Product #' . ($product['product_id'] ?? ($index + 1)));
                $qty = (float) ($product['quantity'] ?? 1);
                $rate = (float) ($product['price'] ?? 0);
                $amount = $qty * $rate;
                $hsn = data_get($product, 'hsn') ?? data_get($product, 'hsn_code') ?? '';
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $productName }}</td>
                <td class="text-center">{{ $order->id ?? '' }}</td>
                <td class="text-center">{{ $invoiceDate }}</td>
                <td class="text-center">{{ $hsn }}</td>
                <td class="text-center">{{ ($cgstPercent + $sgstPercent) }}%</td>
                <td class="text-center">{{ rtrim(rtrim(number_format($qty, 2), '0'), '.') }}</td>
                <td class="text-right">{{ number_format($rate, 2) }}</td>
                <td class="text-right">{{ number_format($amount, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center">1</td>
                <td>CTP PLATE 560*670</td>
                <td class="text-center">{{ $order->id ?? '' }}</td>
                <td class="text-center">{{ $invoiceDate }}</td>
                <td class="text-center">8442</td>
                <td class="text-center">{{ ($cgstPercent + $sgstPercent) }}%</td>
                <td class="text-center">1</td>
                <td class="text-right">{{ number_format($subTotal, 2) }}</td>
                <td class="text-right">{{ number_format($subTotal, 2) }}</td>
            </tr>
        @endforelse

        @for($i = max(0, 3 - count($productList)); $i > 0; $i--)
            <tr class="empty-row">
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endfor
        </tbody>
    </table>

    <table>
        <tr>
            <td style="width:60%; font-size: 11px;">
                Rs. {{ $amountInWords }} Only
            </td>
            <td style="width:40%; padding:0;">
                <table class="inner-table totals">
                    <tr><td style="width:65%;">Sub Total</td><td class="text-right">{{ number_format($subTotal, 2) }}</td></tr>
                    <tr><td>Cartage</td><td class="text-right">0.00</td></tr>
                    <tr><td>CGST {{ number_format($cgstPercent, 2) }} %</td><td class="text-right">{{ number_format($cgst, 2) }}</td></tr>
                    <tr><td>SGST {{ number_format($sgstPercent, 2) }} %</td><td class="text-right">{{ number_format($sgst, 2) }}</td></tr>
                    <tr><td class="bold">Total</td><td class="text-right bold">{{ number_format($finalAmount, 2) }}</td></tr>
                    <tr><td>Round off</td><td class="text-right">0.00</td></tr>
                    <tr><td class="bold">Grand Total</td><td class="text-right bold">Rs {{ number_format($finalAmount, 2) }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width:60%; font-size: 11px;">
                <div>Our Bank Detail:-</div>
                @if($companyBankRecord || $fallbackBankDetail)
                    <div class="bold">{{ $companyBankName }} Account No. {{ $companyAccountNo }}</div>
                    <div class="bold">IFSC CODE : {{ $companyIfsc }}&nbsp;&nbsp; BRANCH : {{ $companyBranch }}</div>
                @else
                    <div class="bold">Account details not available</div>
                @endif
            </td>
            <td style="width:40%; font-size: 11px; text-align:center; vertical-align: middle;" class="bold">
                For {{ $companyName }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width:60%;" class="terms">
                <div class="bold">E &amp; O.E</div>
                <div>1. Subject to U.P. Jurisdiction.</div>
                <div>2. Interest @ 24% will be charged if payment is not made on presentation.</div>
                <div>3. Certified that the goods are in order &amp; rates agreed. Any discrepancy should be brought to our notice within 7 days, otherwise this amount would be treated as correct and accepted.</div>
            </td>
            <td style="width:40%;" class="signature">
                Authorised Signatory
            </td>
        </tr>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function generatePDF() {
        const element = document.querySelector('.invoice-sheet');
        const opt = {
            margin: 4,
            filename: 'invoice-{{ $order->id ?? "001" }}.pdf',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
</body>
</html>
