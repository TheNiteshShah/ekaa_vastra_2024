<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px 30px;
            line-height: 1.4;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            /* margin-bottom: 5px; */
        }

        .tbl {
            border-left: none;
            border-right: none !important;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 4px 5px;
            font-size: 12px;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        h4,
        h5,
        h6 {
            margin: 0;
            font-weight: bold;
        }

        .section-title {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 4px;
        }

        .row,
        .container {
            margin: 0;
            padding: 0;
        }

        .signature-area {
            border-top: 2px solid black;
            margin-top: 50px;
        }

        .signature-area2 {
            margin-top: 50px;
        }

        .border-top-black {
            border-top: 2px solid black;
        }

        .border-bottom-black {
            border-bottom: 2px solid black;
        }

        .p-0 {
            padding: 0 !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .border-0 {
            border: 0 !important;
            padding: 0px !important;

        }

        .m-1 {
            margin: 5px !important;
        }

        .no-border {
            border: none !important;
        }

        .no-vertical-border {
            border-top: 0 !important;
            border-bottom: 0 !important;
            padding: 2px 4px !important;
            /* reduced top/bottom and left/right padding */
        }

        .no-horizontal-border {
            border-left: 0 !important;
            border-right: 0 !important;
            /* reduced top/bottom and left/right padding */
        }
    </style>
</head>

<body>
    <div>
        <div style="border: 1px solid black;border-bottom:none !important">
            <div class="text-right" style="padding: 5px;">
                <p class="m-0">Original for Buyer</p>
            </div>

            <table class="table" style="table-layout: fixed; width: 100%;">
                <tr>
                    <!-- Logo aligned left -->
                    <td style="width: 0%; vertical-align: top; border: none; text-align: left;">
                        <img src="{{ public_path('admin/assets/images/rk_logo.png') }}"
                            style="max-width: 120px; height: auto;">
                    </td>

                    <!-- Company info centered -->
                    <td style="width: 100%; vertical-align: top; border: none; text-align: center;">
                        <h3 class="m-0"><strong><u>GST INVOICE</u></strong></h3>
                        <h1 class="m-0">R K FASHIONS</h1>
                        <p class="m-0">C-275, VAISHALI NAGAR, BEHIND TPS SCHOOL, JAIPUR</p>
                        <h3 class="m-1"><strong>GSTIN: 08AJGPK2857A1ZF</strong></h3>
                        <p class="m-0"><strong><i>Tel.: 9829579161 | Email: rkfashionsjaipur@gmail.com</i></strong>
                        </p>
                    </td>
                </tr>

            </table>
        </div>

        <table class="table">
            <tr>
                <td style="width: 50%; vertical-align: top; padding: 5px;border-bottom:none;">
                    <table style="width: 100%;">
                        <tr>
                            <td class="border-0"><strong>Invoice No</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $financialYear }}/{{ $invoiceNo }}/GST</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Date of Invoice</strong></td>
                            <td class="border-0">
                                :&nbsp;&nbsp;{{ \Carbon\Carbon::parse($bill_data->invoice_date)->format('d-m-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Place of Supply</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $bill_data->vendor->city->name }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Reverse Charge</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $bill_data->reverse_charge }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding: 5px;border-bottom:none;">
                    <table style="width: 100%;">
                        <tr>
                            <td class="border-0"><strong>Challan No.</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $bill_data->challan_no }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Transport</strong></td>
                            <td class="border-0">
                                :&nbsp;&nbsp;{{ $bill_data->transport }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Vehicle No.</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $bill_data->vehicle_noe }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Station</strong></td>
                            <td class="border-0">:&nbsp;&nbsp;{{ $bill_data->station }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <td style="border-bottom:none;padding-bottom:10px">
                    <strong><i>Billed to:</i></strong><br>
                    {{ $bill_data->vendor->business_name }}<br>
                    {{ $bill_data->vendor->address }}, {{ $bill_data->vendor->city->name }},
                    {{ $bill_data->vendor->city->state->name }} - {{ $bill_data->vendor->pin_code }}<br>
                    Mobile: {{ $bill_data->vendor->phone }}<br>
                    GSTIN/UIN: {{ $bill_data->vendor->gst }}<br>
                </td>
                <td style="border-bottom:none;padding-bottom:10px">
                    <strong><i>Shipped to</i></strong><br>
                    {{ $bill_data->vendor->business_name }}<br>
                    {{ $bill_data->vendor->address }}, {{ $bill_data->vendor->city->name }},
                    {{ $bill_data->vendor->city->state->name }} - {{ $bill_data->vendor->pin_code }}<br>
                    Mobile: {{ $bill_data->vendor->phone }}<br>
                    GSTIN/UIN: {{ $bill_data->vendor->gst }}<br>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 8%;" class="text-right">S. No.</th>
                    <th style="width: 42%;" class="text-left">Description of Goods</th>
                    <th style="width: 10%;" class="text-right">Qty</th>
                    <th style="width: 10%;" class="text-left">Unit</th>
                    <th style="width: 15%;" class="text-right">Price</th>
                    <th style="width: 15%;" class="text-right" style="padding-top:none">
                        Amount (<span style="font-family: DejaVu Sans;">&#8377;</span>)
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalRows = 8;
                    $itemCount = count($bill_data->orderDetails);
                    $setTotal = 0;
                    $pcTotal = 0;
                @endphp
                @foreach ($bill_data->orderDetails as $item)
                    @php
                        if ($item->unit == 'Set') {
                            $setTotal += $item->quantity;
                        } elseif ($item->unit == 'Pc') {
                            $pcTotal += $item->quantity;
                        }
                    @endphp
                    <tr>
                        <td class="text-right no-vertical-border">{{ $loop->iteration }}</td>
                        <td class="no-vertical-border">{{ $item->name }}</td>
                        <td class="no-vertical-border"class="text-right no-vertical-border">{{ $item->quantity }}</td>
                        <td class="no-vertical-border">{{ $item->unit }}</td>
                        <td class="text-right no-vertical-border">{{ number_format($item->price, 2) }}</td>
                        <td class="text-right no-vertical-border">
                            {{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
                @for ($i = $itemCount + 1; $i <= $totalRows; $i++)
                    <tr>
                        <td class="text-right no-vertical-border"></td>
                        <td class="no-vertical-border">&nbsp;</td>
                        <td class="text-right no-vertical-border">&nbsp;</td>
                        <td class="no-vertical-border">&nbsp;</td>
                        <td class="text-right no-vertical-border">&nbsp;</td>
                        <td class="text-right no-vertical-border">-</td>
                    </tr>
                @endfor
                <tr>
                    <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
                    <td class="text-right"><b>{{ number_format($bill_data->sub_total, 2) }}</b></td>
                </tr>
                @if ($bill_data->vendor->city->state->name == 'Rajasthan [RJ]')
                    <tr>
                        <td colspan="2" style="border-right:0"></td>
                        <td class="product_table no-horizontal-border" colspan="2"><i>Add : CGST</i></td>
                        <td class="product_table no-horizontal-border"><i>@
                                {{ number_format($bill_data->gst / 2, 2, '.', ',') }}%</i></td>
                        <td class="product_table" style="border-left: 1px solid black;text-align:right">
                            {{ number_format($bill_data->gst_amount / 2, 2, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-right:0"></td>
                        <td class="product_table no-horizontal-border" colspan="2"><i>Add : SGST</i></td>
                        <td class="product_table no-horizontal-border"><i>@
                                {{ number_format($bill_data->gst / 2, 2, '.', ',') }}%</i></td>
                        <td class="product_table" style="border-left: 1px solid black;text-align:right">
                            {{ number_format($bill_data->gst_amount / 2, 2, '.', ',') }}</td>

                    </tr>
                @else
                    <tr>
                        <td colspan="2" style="border-right:0"></td>
                        <td class="product_table no-horizontal-border" colspan="2"><i>Add : IGST</i></td>
                        <td class="product_table no-horizontal-border"><i>@
                                {{ number_format($bill_data->gst, 2, '.', ',') }}%</i></td>
                        <td class="product_table" style="border-left: 1px solid black;text-align:right">
                            {{ number_format($bill_data->gst_amount, 2, '.', ',') }}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2" style="border-right:0"></td>
                    <td class="product_table no-horizontal-border" colspan="2"><i>Rounded Off (+/-)</i></td>
                    <td class="product_table no-horizontal-border"></td>
                    <td class="product_table" style="border-left: 1px solid black;text-align:right">
                        {{ number_format(abs($bill_data->total_amount - round($bill_data->total_amount)), 2, '.', ',') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="border-right:0;border-bottom:none;"></td>
                    <td class="product_table no-horizontal-border" colspan="2"
                        style="text-align: center;border-bottom:none;">
                        <b>Grand Total</b>
                    </td>
                    <td class="product_table no-horizontal-border" colspan="1"
                        style="text-align: left;border-bottom:none;">
                        <b>Sets:</b> {{ $setTotal }}
                    </td>
                    <td class="product_table no-horizontal-border" colspan="1"
                        style="text-align: center;border-bottom:none;">
                        <b>Pcs:</b> {{ $pcTotal }}
                    </td>
                    <td class="product_table" style="text-align:right;border-bottom:none !important;">
                        <b>{{ number_format($bill_data->total_amount, 2, '.', ',') }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <tr>
                <td class="product_table text-center no-horizontal-border"
                    style="text-decoration: underline;font-size:10px; border-left: 1px solid black !important;">
                    <strong>Tax Rate(%)</strong><br>
                    {{ number_format($bill_data->gst, 2, '.', ',') }}%
                </td>

                <td class="product_table text-center no-horizontal-border"
                    style="text-decoration: underline;font-size:10px">
                    <strong>Taxable Amt.</strong><br>
                    {{ number_format($bill_data->sub_total, 2, '.', ',') }}
                </td>

                @if ($bill_data->vendor->city->state->name == 'Rajasthan [RJ]')
                    <td class="product_table text-center no-horizontal-border"
                        style="text-decoration: underline;font-size:10px">
                        <strong>CGST Amt.</strong><br>
                        {{ number_format($bill_data->gst_amount / 2, 2, '.', ',') }}
                    </td>

                    <td class="product_table text-center no-horizontal-border"
                        style="text-decoration: underline;font-size:10px">
                        <strong>SGST Amt.</strong><br>
                        {{ number_format($bill_data->gst_amount / 2, 2, '.', ',') }}
                    </td>
                @else
                    <td class="product_table text-center no-horizontal-border"
                        style="text-decoration: underline;font-size:10px">
                        <strong>IGST Amt.</strong><br>
                        {{ number_format($bill_data->gst_amount, 2, '.', ',') }}
                    </td>
                @endif

                <td class="product_table text-center no-horizontal-border"
                    style="text-decoration: underline;font-size:10px;border-right: 1px solid black !important;">
                    <strong>Total Tax</strong><br>
                    {{ number_format($bill_data->gst_amount, 2, '.', ',') }}
                </td>
            </tr>

        </table>

        <table class="table">
            <tr>
                <<td style="width: 50%; vertical-align: top;border-top:none">
                    <strong>Amount in Words:</strong><br>
                    {{ $amountInWords }}
                    </td>
                    <td style="width: 50%; text-align: right; vertical-align: bottom;border-top:none">
                        <strong>JOBWORK ONLY</strong>
                    </td>
            </tr>
        </table>

        <div class="no-vertical-border" style="border:1px solid black;padding:10px">
            <h4 class="text-center" style="text-decoration: underline;">BANK DETAILS</h4>
            <table class="table no-border">
                <tr>
                    <td class="text-center no-border">BANK: IDBI BANK LTD.</td>
                    <td class="text-center no-border">Current A/C NO: 0273102000028945</td>
                    <td class="text-center no-border">IFSC: IBKL0000273</td>
                </tr>
            </table>
        </div>

        <table class="table">
            <tr>
                <td style="width: 50%;">
                    <h5 class="section-title">Terms & Conditions</h5>
                    <p class="m-0">E.& O.E.</p>
                    <ul style="margin: 0; padding-left: 15px;">
                        <li>Goods once sold will not be taken back.</li>
                        <li>Interest @18% p.a. will be charged if payment is delayed.</li>
                        <li>Subject to 'Rajasthan' jurisdiction only.</li>
                    </ul>
                </td>
                <td style="width: 50%; text-align: right;">
                    <h5 style="text-align: left; vertical-align: top;"><strong>Receiver's
                            Signature&nbsp;&nbsp;:</strong></h5>
                    <div class="signature-area"></div>
                    <div class="signature-area2"></div>
                    <h5>For R K FASHIONS</h5>
                    <strong>Authorised Signatory</strong>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
