<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') }} - Invoice #{{ $order->id ?? '' }}</title>
    <meta name="author" content="{{ config('app.name') }}" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
            /* display: flex; */
            /* justify-content: center; */
        }
        .invoice-container{
            display: flex;
            justify-content: center;
        }
        p {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
            margin: 0pt;
        }

        .s1 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 16pt;
        }

        .s2 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s3 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s4 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10pt;
        }

        .s5 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        .s6 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        .s7 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s8 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
            vertical-align: 1pt;
        }

        .s9 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10pt;
        }

        .s10 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s11 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s13 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s14 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .s15 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
            vertical-align: -5pt;
        }

        .s16 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .s17 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
            vertical-align: -7pt;
        }

        li {
            display: block;
        }

        #l1 {
            padding-left: 0pt;
            counter-reset: c1 1;
        }

        #l1>li>*:first-child:before {
            counter-increment: c1;
            content: counter(c1, decimal) ". ";
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        #l1>li:first-child>*:first-child:before {
            counter-increment: c1 0;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }

        .toolbar {
            padding: 10px 20px;
            background: #f5f5f5;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-modern {
            padding: 8px 18px;
            border: none;
            border-radius: 5px;
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
            .toolbar {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    {{-- Print / Export Toolbar --}}
    <div class="toolbar">
        <button type="button" class="btn-modern btn-print" onclick="window.print()">
            🖨 Print
        </button>
        <button type="button" class="btn-modern btn-pdf" onclick="window.print()">
            📄 Export as PDF
        </button>
    </div>

    <p style="padding-top: 1pt; text-indent: 0pt; text-align: center">TAX INVOICE</p>
    <p style="text-indent: 0pt; text-align: left"><br /></p>
  <div class="invoice-container">
    <table style="border-collapse: collapse; margin-left: 6.51pt" cellspacing="0">

        {{-- ===== HEADER: Company Info + Invoice Meta ===== --}}
        <tr style="height: 10pt">
            <td style="width:431pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="7" rowspan="4">
                <p class="s1" style="padding-left:5pt;text-indent:0pt;text-align:left;">
                    <img width="111" height="50" src="{{ asset('images/config/'.config('app.logo')) }}" alt="{{ config('app.name') }} Logo" style="margin-top:8px;" />
                    <span style="padding-left:60pt; padding-top:0pt;">{{ strtoupper(config('app.name')) }}</span>
                </p>
                <p class="s2" style="padding-left:110pt;padding-right:14pt;text-indent:0pt;text-align:center;">
                    {{ config('app.address') }} &nbsp; <br>Phone : {{ config('app.contact_us') }}
                </p>
                <p class="s2" style="padding-left:99pt;text-indent:0pt;text-align:center;">
                    Email Id : <a href="mailto:{{ config('app.email_account') }}" class="s3">{{ config('app.email_account') }}</a>
                </p>
                <p class="s4" style="padding-top:5pt; padding-bottom:5pt;padding-left:161pt;text-indent:0pt;text-align:left;">
                     GST : 09BWCPK8018F1ZJ 
                    &nbsp; PAN :BWCPK8018F
                </p>
             
            </td>

            <td style="width:119pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s5" style="padding-top:4pt;padding-left:3pt;text-indent:0pt;text-align:left;">
                    Invoice No. {{ $order->id ?? '' }} /{{ now()->format('y-') . (now()->year + 1 - 2000) }}
                </p>
            </td>
        </tr>

        <tr style="height: 15pt">
            <td style="width:119pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s5" style="padding-top:2pt;padding-left:3pt;text-indent:0pt;text-align:left;">
                    Dated {{ now()->format('d/M/Y') }}
                </p>
            </td>
        </tr>

        <tr style="height: 19pt">
            <td style="width:119pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s6" style="padding-left:3pt;text-indent:0pt;text-align:left;">
                    Eway No. {{ $order->eway_no ?? '' }}
                </p>
            </td>
        </tr>

        <tr style="height: 21pt">
            <td style="width:119pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s6" style="padding-top:4pt;padding-left:3pt;text-indent:0pt;text-align:left;">
                    Vehicle No. {{ $order->vehicle_no ?? '' }}
                </p>
            </td>
        </tr>

        {{-- ===== BILLING & SHIPPING ADDRESS ===== --}}
        <tr style="height: 78pt">
            <td style="width:272pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s7" style="padding-left:6pt;text-indent:0pt;text-align:left;">Detail of Receiver ( Billed To)</p>
                <p class="s4" style="padding-top:3pt;padding-left:6pt;text-indent:0pt;text-align:left;">
                    M/s {{ strtoupper($order->user->name ?? '') }}
                </p>
                <p class="s7" style="padding-top:6pt;padding-left:6pt;text-indent:0pt;text-align:left;">
                    {{ strtoupper($address['address'] ?? '') }}, {{ strtoupper($address['city'] ?? '') }}
                </p>
                <p style="text-indent:0pt;text-align:left;"><br /></p>
                <p class="s8" style="padding-left:6pt;text-indent:0pt;text-align:left;">
                    GSTIN No. <span class="s9">{{ $order->user->gst_number ?? '' }}</span>
                </p>
            </td>

            <td style="width:278pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="6">
                <p class="s7" style="padding-left:2pt;text-indent:0pt;text-align:left;">Detail of Consignee ( Shipped To)</p>
                <p class="s4" style="padding-top:3pt;padding-left:2pt;text-indent:0pt;text-align:left;">
                    M/s {{ strtoupper($order->user->name ?? '') }}
                </p>
                <p class="s7" style="padding-top:6pt;padding-left:2pt;text-indent:0pt;text-align:left;">
                    {{ strtoupper($address['address'] ?? '') }} {{ strtoupper($address['city'] ?? '') }} {{ strtoupper($address['state'] ?? '') }}
                </p>
            </td>
        </tr>

        {{-- ===== TABLE HEADER ===== --}}
        <tr style="height: 15pt">
            <td style="width:26pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:2pt;text-indent:0pt;line-height:9pt;text-align:left;">S. No.</p>
            </td>
            <td style="width:204pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="text-indent:0pt;line-height:9pt;text-align:center;">Particulars</p>
            </td>
            <td style="width:42pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:4pt;text-indent:0pt;line-height:9pt;text-align:left;">Ch. No.</p>
            </td>
            <td style="width:69pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:4pt;padding-right:3pt;text-indent:0pt;line-height:9pt;text-align:center;">Ch. Date</p>
            </td>
            <td style="width:41pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:3pt;text-indent:0pt;line-height:9pt;text-align:center;">HSN/SAC</p>
            </td>
            <td style="width:24pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:2pt;text-indent:0pt;line-height:9pt;text-align:center;">Tax</p>
            </td>
            <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-left:22pt;text-indent:0pt;line-height:9pt;text-align:left;">Qty</p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-right:4pt;text-indent:0pt;line-height:9pt;text-align:right;">Rate</p>
            </td>
            <td style="width:55pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p class="s10" style="padding-right:4pt;text-indent:0pt;line-height:9pt;text-align:right;">Amount</p>
            </td>
        </tr>

        {{-- ===== PRODUCT ROWS ===== --}}
        @php
            $productList = [];
            if (isset($products['product_id'])) {
                $productList = [$products];
            } elseif (is_array($products) && isset($products[0])) {
                $productList = $products;
            }
        @endphp

        @if(count($productList) > 0)
            @foreach($productList as $index => $product)
                @php
                    $productModel = \App\Models\Product::find($product['product_id'] ?? null);
                    $rowAmount = ($product['price'] ?? 0) * ($product['quantity'] ?? 1);
                @endphp
                <tr style="height: 22pt">
                    <td style="width:26pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:4pt;text-indent:0pt;text-align:left;">{{ $loop->iteration }}</p>
                    </td>
                    <td style="width:204pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:3pt;text-indent:0pt;line-height:10pt;text-align:left;">
                            {{ $productModel->name ?? ('Product #' . ($product['product_id'] ?? 'N/A')) }}
                            @if(isset($product['variations']) && is_array($product['variations']))
                                &nbsp;
                                @foreach($product['variations'] as $key => $value)
                                    {{ $key }}: {{ $value }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            @endif
                        </p>
                    </td>
                    <td style="width:42pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:7pt;text-indent:0pt;text-align:left;">{{ $product['ch_no'] ?? '' }}</p>
                    </td>
                    <td style="width:69pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:4pt;text-indent:0pt;text-align:center;">
                            {{ isset($product['ch_date']) ? \Carbon\Carbon::parse($product['ch_date'])->format('d/M/Y') : '' }}
                        </p>
                    </td>
                    <td style="width:41pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:4pt;text-indent:0pt;text-align:center;">{{ $productModel->hsn_code ?? ($product['hsn'] ?? '') }}</p>
                    </td>
                    <td style="width:24pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-left:2pt;padding-right:1pt;text-indent:0pt;text-align:center;">
                            18%
                        </p>
                    </td>
                    <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-right:1pt;text-indent:0pt;text-align:right;">{{ $product['quantity'] ?? 1 }}</p>
                    </td>
                    <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-right:4pt;text-indent:0pt;text-align:right;">{{ number_format($product['price'] ?? 0, 2) }}</p>
                    </td>
                    <td style="width:55pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#c0c0c0;border-right-style:solid;border-right-width:2pt;">
                        <p class="s11" style="padding-right:4pt;text-indent:0pt;text-align:right;">{{ number_format($rowAmount, 2) }}</p>
                    </td>
                </tr>
            @endforeach
        @else
            <tr style="height: 22pt">
                <td colspan="9" style="border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                    <p class="s11" style="text-align:center;">No product details available</p>
                </td>
            </tr>
        @endif

        {{-- ===== EMPTY FILLER ROW ===== --}}
        <tr style="height: 310pt">
            @for($i = 0; $i < 9; $i++)
            <td style="border-top-style:solid;border-top-width:2pt;border-top-color:#c0c0c0;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;">
                <p style="text-indent:0pt;text-align:left;"><br /></p>
            </td>
            @endfor
        </tr>

        {{-- ===== TOTALS ROW 1: Amount in words + SubTotal ===== --}}
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
      $orderExtraRaw = data_get($order, 'extra_charge')
        ?? data_get($order, 'extra_charges')
        ?? data_get($order, 'extra_charge_amount')
        ?? data_get($order, 'extra_charge_value')
        ?? data_get($order, 'extra_amount')
        ?? data_get($order, 'extra')
        ?? null;

    $extraChargeFromProducts = 0;
    foreach ($productList as $p) {
        $lineExtraRaw = data_get($p, 'extra_charges')
            ?? data_get($p, 'extra_charge')
            ?? data_get($p, 'extra_amount')
            ?? 0;

        // Supports both numeric value and structured charge arrays.
        if (is_array($lineExtraRaw)) {
            $lineExtra = 0;
            foreach ($lineExtraRaw as $chargeItem) {
                $lineExtra += (float) (data_get($chargeItem, 'charge') ?? $chargeItem ?? 0);
            }
        } else {
            $lineExtra = (float) $lineExtraRaw;
        }

        $lineQty = (float) (data_get($p, 'quantity') ?? 1);
        $extraChargeFromProducts += $lineExtra * $lineQty;
    }

    $hasOrderExtra = $orderExtraRaw !== null && $orderExtraRaw !== '';
    $extraCharge = $hasOrderExtra ? (float) $orderExtraRaw : $extraChargeFromProducts;
            $cgstAmount  = ($subTotal + $extraCharge ?? 0) * (($cgstPercent ?? 9) / 100);
            $sgstAmount  = ($subTotal + $extraCharge ?? 0) * (($sgstPercent ?? 9) / 100);
            $igstAmount  = ($subTotal + $extraCharge ?? 0) * (($igstPercent ?? 0) / 100);
            $cartage     = $extraCharge;
            $roundOff    = $order->round_off ?? 0;
            $grandTotal  = ($subTotal ?? 0) + $cgstAmount + $sgstAmount + $igstAmount + $cartage + $roundOff;
                $amountInWords = invoice_number_to_words((int) round($grandTotal));
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

        <tr style="height: 18pt">
            <td style="width:341pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="4" rowspan="2">
                <p class="s13" style="padding-top:4pt;padding-left:6pt;text-indent:0pt;text-align:left;">
                       Rs. {{ $amountInWords }} Only
                </p>
            </td>
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:3pt;padding-left:3pt;text-indent:0pt;text-align:left;">Sub Total</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:4pt;padding-left:63pt;text-indent:0pt;text-align:left;">{{ number_format($subTotal ?? 0, 2) }}</p>
            </td>
        </tr>

        <tr style="height: 15pt">
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:2pt;padding-left:3pt;text-indent:0pt;text-align:left;">Extracharges</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:2pt;padding-right:5pt;text-indent:0pt;text-align:right;">{{ number_format($cartage, 2) }}</p>
            </td>
        </tr>

        {{-- ===== CGST ROW ===== --}}
        <tr style="height: 18pt">
            <td style="width:341pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="4" rowspan="2">
                <p style="text-indent:0pt;text-align:left;"><br /></p>
            </td>
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:3pt;padding-left:3pt;text-indent:0pt;text-align:left;">
                    CGST {{ $cgstPercent ?? 9 }}.00 %
                </p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:4pt;padding-right:4pt;text-indent:0pt;text-align:right;">{{ number_format($cgstAmount, 2) }}</p>
            </td>
        </tr>

        {{-- ===== SGST ROW ===== --}}
        <tr style="height: 15pt">
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:2pt;padding-left:3pt;text-indent:0pt;text-align:left;">
                    SGST {{ $sgstPercent ?? 9 }}.00 %
                </p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:2pt;padding-right:4pt;text-indent:0pt;text-align:right;">{{ number_format($sgstAmount, 2) }}</p>
            </td>
        </tr>

        {{-- ===== BANK DETAILS + TOTAL / ROUND OFF / GRAND TOTAL ===== --}}
        <tr style="height: 17pt">
            <td style="width:341pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="4" rowspan="3">
                <p class="s13" style="padding-top:4pt;padding-left:6pt;text-indent:0pt;text-align:left;">Our Bank Detail:-</p>
                @if($companyBankRecord || $fallbackBankDetail)
                <p class="s14" style="padding-top:4pt;padding-left:6pt;text-indent:0pt;text-align:left;">
                    {{ $companyBankName }} Account No.50459477773
                </p>
                <p class="s9" style="padding-top:4pt;padding-left:6pt;text-indent:0pt;text-align:left;">
                    IFSC CODE : {{ $companyIfsc }} &nbsp; BRANCH : {{ $companyBranch }}
                </p>
                    @else
                    <div class="bold">Account details not available</div>
                @endif
            </td>
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:3pt;padding-left:3pt;text-indent:0pt;text-align:left;">Total</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:4pt;padding-left:63pt;text-indent:0pt;text-align:left;">{{ number_format($grandTotal, 2) }}</p>
            </td>
        </tr>

        <tr style="height: 18pt">
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s11" style="padding-top:1pt;padding-left:3pt;text-indent:0pt;text-align:left;">Round off</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s11" style="padding-top:2pt;padding-right:4pt;text-indent:0pt;text-align:right;">{{ number_format($roundOff, 2) }}</p>
            </td>
        </tr>

        <tr style="height: 20pt">
            <td style="width:104pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="3">
                <p class="s5" style="padding-top:1pt;padding-left:3pt;text-indent:0pt;text-align:left;">Grand Total</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="2">
                <p class="s13" style="padding-left:4pt;text-indent:0pt;text-align:left;">
                    <span class="s2">{{ number_format($grandTotal + $roundOff, 2) }}</span>
                </p>
            </td>
        </tr>

        {{-- ===== FOOTER: T&C + Authorised Signatory ===== --}}
        <tr style="height: 70pt">
            <td style="width:550pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt;" colspan="9">
                <p class="s15" style="padding-left:9pt;text-indent:0pt;text-align:left;">
                    E &amp; O.E <span class="s16" style="padding-left:300pt">For {{ strtoupper(config('app.name')) }}</span>
                </p>
                <ol id="l1">
                    <li data-list-text="1.">
                        <p class="s13" style="padding-top:6pt;padding-left:17pt;text-indent:-10pt;text-align:left;">
                            Subject to U.P. Jurisdiction.
                        </p>
                    </li>
                    <li data-list-text="2.">
                        <p class="s13" style="padding-left:17pt;text-indent:-10pt;text-align:left;">
                            Interest @ 24% will be charged if payment is not made on presentation.
                        </p>
                    </li>
                    <li data-list-text="3.">
                        <p class="s13" style="padding-left:17pt;text-indent:-10pt;text-align:left;">
                            Certified that the goods are in order &amp; rates agreed.
                            <br> should be brought to our notice within 7 days. <br>
                    otherwise this amount would be treated as correct and accepted.
                        </p>
                    </li>
                </ol>
                
               <p class="" style="padding-left:15pt;padding-bottom:15pt;text-indent:2pt;line-height:70%;text-align:left;">
                    
                    <span class="" style="padding-left: 400pt;">Authorised Signatory </span>
                </p>
                </td>
        </tr>

    </table>
    </div>
</body>
</html>