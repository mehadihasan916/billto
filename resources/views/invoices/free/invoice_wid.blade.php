{{-- three invoice --}}
<style>
    @page {
        padding: 0;
        margin: 160px 0 0 0;
    }

    /* same spacing on every page so the fixed header area is available */
    @page :first {
        /* keep first page the same as others so header space is consistent */
        margin: 160px 0 0 0;
    }



    /* main body */
    .invoice_body {
        width: 100%;
        display: flex;
    }

    .invoiceNumberLaft {
        float: right;
        width: 100%;
    }

    .fullInvoice {
        float: right;
        width: 85%;

    }

    /* start frist sec  */
    .first_section {
        width: 100%;
        display: flex;
    }

    .leftSideArea {
        float: left;
        width: 48%;
        /* border:1px solid red; */
    }

    .rightSideArea {
        float: right;
        width: 35%;
        /* border:1px solid red; */
    }

    .third_section {
        width: 100%;
        display: flex;

    }

    .left_Side_bar {
        width: 30%;
        background-color: #0370BF;
        float: left;
    }



    .c {
        /* color: #FFF; */
        font-size: 16px;
        padding-top: 5px;
    }


    .d {
        padding: 5px;
        color: #FFF;
        line-height: 24px;
        font-size: 16px;
    }


    .margin_left_terms {
        /* margin-left: 10%; */
    }

    .empty_div {
        width: 25%;
        float: left;
    }

    .table_div {
        width: 75%;
        float: right;
        text-align: right;
        padding-right: 20px;
    }

    .page {
        background: var(--white);
        display: block;
        margin: 0 auto;
        position: relative;
        box-shadow: var(--pageShadow);
    }


    .termsFelx {
        display: flex;
        width: 100%;
    }

    .termsAndConditionDiv {
        float: left;
        width: 65%;
    }

    .signature_div {
        float: right;
        width: 35%;
        text-align: center;
        padding-top: 10px;
    }


    /* dompdf: fixed header so logo repeats on every page */
    header.invoice-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 140px;
        z-index: 10;
    }

    .invoice-logo {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 150px;
        border-bottom: 1px solid #bf1903;
        padding-bottom: 2px;
    }
</style>
<style>
    .page-bottom-note {
        position: fixed;
        bottom: 15px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 11px;
        color: #686868;
        margin-top: 40px;
    }
</style>

{{-- dompdf does not support mPDF <htmlpageheader>; keeping header content is handled by fixed positioning in CSS above --}}
<title>Billto.io</title>


</head>

<body>


    <div class="invoice_body page">
        {{-- <div class="invoiceNumberLaft">
            <table>
                <tr text-rotate="90">
                    <td style="padding-left:55px; color:#CC3D3B; padding-top:50%; font-size:21px">
                        <h1>Invoice: {{ $invoiceData->invoice_id }}</h1>
                    </td>
                </tr>
            </table>
        </div> --}}
        <div class="fullInvoice">
            <section>
                <div class="first_section" style="border-bottom: 1px solid #CC3D3B; width:89%">
                    <div class="leftSideArea">
                        <div style="">
                            <h4 style="font-size:21px;color:#CC3D3B; margin:0px;">Women in digital</h4>
                            <p style="font-size:11px; margin:4px;">House 50-51(1st Floor) , Janata Co-operative Housing
                                Society, Ring Road, Mohammadpur, Dhaka,
                                Bangladesh 01635 497868 | info@womenindigital.net | womenindigital.net</p>
                        </div>
                        <div style=" margin-top:22px ">
                            <h4 style="font-size:11px;color:#CC3D3B; margin:0px;">Billing Address:</h4>
                            <p style="font-size:11px; margin:4px;">{{ $invoiceData->invoice_form }} </p>
                        </div>
                    </div>
                    <div class="rightSideArea" style="margin-bottom: 15px">
                        <div style="text-align:right;    ">
                            {{-- @if ($userInvoiceLogo->invoice_logo != '')
                                <img style="object-fit: fill; "
                                    src="{{ public_path('storage/invoice/logo/' . $userInvoiceLogo->invoice_logo) }}"
                                    alt="img"
                                    style="width: 60%; height:20%; padding-top:5px;padding-bottom: 30%; ">
                            @endif --}}
                            <header class="invoice-header">
                                @if ($userInvoiceLogo->invoice_logo)
                                    <img class="invoice-logo"
                                        src="{{ public_path('storage/invoice/logo/' . $userInvoiceLogo->invoice_logo) }}">
                                @endif
                            </header>
                        </div>
                        <div class="" style="color: #686868;margin-left:6px; ">
                            <table style="padding-left:20%;  ">
                                <tr>
                                    <td style="text-align:left; font-size:13px; color: #CC3D3B;font-weight: bold">
                                        {{ __('messages.Invoice_Date') }}</td>
                                    <td style="text-align: right; font-size:13px ; padding-left:6% ">
                                        {{ $invoiceData->invoice_date }}</td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; font-size:13px; color: #CC3D3B;font-weight: bold">
                                        {{ __('messages.P.O.') }}#</td>
                                    <td style="text-align: right; font-size:13px; ">
                                        {{ $invoiceData->invoice_po_number }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; font-size:13px;color: #CC3D3B; font-weight: bold">
                                        {{ __('messages.Due_Date') }}</td>
                                    <td style="text-align: right; font-size:13px;">
                                        {{ $invoiceData->invoice_dou_date }}
                            </table>
                        </div>
                    </div>
                </div>
                <div style=" margin-top:8px ">
                    <h4 style="font-size:13px;color:#CC3D3B; margin:0px;">Bill To</h4>
                    <p style="font-size:11px; margin:4px;">{{ $invoiceData->invoice_to }} </p>
                </div>
            </section>

            <section class="second_section">
                <div class="table">
                    <div style=" margin-right:10%;  padding-bottom:15px;">
                        <div style="height:200px;">

                            <table class="table1" width="100%" cellspacing="0" cellpadding="0"
                                style="border-collapse:collapse; table-layout:fixed;">

                                <!-- DEFINE COLUMNS ONCE -->
                                <colgroup>
                                    @for ($i = 1; $i <= 13; $i++)
                                        <col style="width:7.69%">
                                    @endfor
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th colspan="10"
                                            style="background:#CC3D3B; padding-left:10px;
                text-align:left; font-size:13px; line-height:29px;
                text-transform:uppercase; color:#fff;">
                                            {{ __('messages.description') }}
                                        </th>
                                        <th style="background:#CC3D3B; padding-left:10px; color:#fff;">
                                            {{ __('messages.qty') }}
                                        </th>
                                        <th
                                            style="background:#CC3D3B; padding-left:10px; color:#fff; white-space:nowrap;">
                                            {{ __('messages.unit_price') }}
                                        </th>
                                        <th
                                            style="background:#CC3D3B; padding-right:20px; text-align:right; color:#fff;">
                                            {{ __('messages.amount') }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $count = 0; @endphp

                                    @foreach ($productsDatas as $product_detail)
                                        <tr>
                                            <td colspan="10"
                                                style="background:#F2F2F2; padding:8px 10px;  border:1px solid #ffffff; font-size:13px;">
                                                {{ $product_detail->product_name }}
                                            </td>
                                            <td
                                                style="background:#F2F2F2; padding:8px 10px;  border:1px solid #ffffff; font-size:13px;">
                                                {{ $product_detail->product_quantity }}
                                            </td>
                                            <td
                                                style="background:#F2F2F2; padding:8px 10px;  border:1px solid #ffffff; font-size:13px;">
                                                {{ number_format($product_detail->product_rate, 2) }}
                                            </td>
                                            <td
                                                style="background:#F2F2F2; padding:8px 20px; text-align:right;  border:1px solid #ffffff; font-size:13px;">
                                                {{ number_format($product_detail->product_amount, 2) }}
                                            </td>
                                        </tr>
                                        @php $count++; @endphp
                                    @endforeach

                                    <!-- FILLER ROWS -->
                                    @for ($x = $count; $x < 5; $x++)
                                        <tr>
                                            <td colspan="10" style="background:#F2F2F2; ">&nbsp;</td>
                                            <td style="background:#F2F2F2;">&nbsp;</td>
                                            <td style="background:#F2F2F2;">&nbsp;</td>
                                            <td style="background:#F2F2F2;">&nbsp;</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>



                        </div>
                        <div style="  width:100%; display:flex; margin-left:30%;">

                            <style>
                                .col_60 {
                                    width: 64.95%;
                                    float: left;
                                    text-align: right;

                                }

                                .col_60 p {
                                    text-align: right;
                                    padding: 5px 10px 0px 10px;
                                    margin: 0px;
                                    font-size: 13px;
                                    font-weight: 500;
                                }

                                .col_40 {
                                    width: 35%;
                                    float: right;
                                    /* background: #F2F2F2; */
                                    text-align: right;
                                }

                                .col_40 p {
                                    text-align: right;
                                    padding: 5px 20px 0px 10px;
                                    margin: 0px;
                                    font-size: 13px;
                                    font-weight: 500;
                                    /* color: #686868; */
                                }
                            </style>
                            <div class="col_60">
                                <p>{{ __('messages.Subtotal') }}</p>
                                <p> {{ __('messages.Sales_Tax') }} ({{ $tax = $invoiceData->invoice_tax_percent }}%)
                                </p>
                                <p>{{ __('messages.Discount_Amount') }} ({{ $tax = $invoiceData->discount_percent }}%)
                                </p>
                                <p>{{ __('messages.Receive_Advance_Amount') }} ({{ $invoiceData->currency }})</p>
                                <p>{{ __('messages.Requesting_Advance_Amount') }}({{ $invoiceData->requesting_advance_amount_percent }}%)
                                </p>
                                <h5
                                    style="font-size:16px;  padding:5px 10px 0px 10px; margin:0px; border-top:1px solid red;">
                                    {{ __('messages.Total') }}</h5>

                            </div>
                            <div class="col_40">
                                <p>{{ number_format($subtotal = $invoiceData->subtotal_no_vat, 2) }}</p>
                                <p> {{ number_format($tax_value = ($subtotal * $tax) / 100, 2) }}</p>
                                <p>{{ number_format($invoiceData->discount_amounts, 2) }}</p>
                                <p>{{ number_format($invoiceData->receive_advance_amount, 2) }}</p>
                                <p>{{ number_format(($invoiceData->final_total * $invoiceData->requesting_advance_amount_percent) / 100, 2) }}
                                </p>
                                <h5
                                    style="font-size:16px;  padding:5px 20px 0px 10px; margin:0px; border-top:1px solid red;">
                                    {{ $invoiceData->currency }}
                                    {{ number_format($invoiceData->final_total - $invoiceData->receive_advance_amount, 2) }}

                                </h5>
                            </div>
                            <div
                                style="font-size:13px; color:#050505; display:inline-block; width:100%; float:right; text-align:right">
                                In word ({{ $amountInWords }} only)
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <section class="third_section">

                <div class="right_Side_bar " style="width:89%">

                    <div class="margin_left_terms">
                        <div class="thanks" style="">
                            <h5 style=" margin:0; padding-bottom:10px;font-weight: 400; font-size: 16px;  width: 80%">
                                {{ __('messages.Thank_You_for_your_business') }}
                            </h5>
                        </div>
                        <div class="termsFelx">
                            <div class="termsAndConditionDiv" style="color: #686868;">
                                <p
                                    style="border-bottom:1px solid #C4C4C4;padding-bottom:12px; font-weight: bold;font-size: 11px;color: #CC3D3B; text-transform: uppercase;">
                                    {{ __('messages.Terms_&_conditions') }}</p>
                                <p style="font-size: 11px;">{{ $userInvoiceLogo->terms }}</p>
                                <p style="font-size: 11px;">{{ $invoiceData->invoice_notes }}</p>
                            </div>
                            <div class="signature_div">
                                @if ($userInvoiceLogo->signature != '')
                                    <img style="object-fit:contain;" style="width: 80px; height:80px;"
                                        src="{{ public_path('uploads/signature/' . $userInvoiceLogo->signature) }}"
                                        alt="img">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

    </div>

    </div>

    </div>
