{{-- template two  --}}
<!DOCTYPE html>
<html class="no-js" lang="bn">
<meta charset="UTF-8">

<head>
    <style>
        @page {
            /* margin: 20px 0 0 0; */
            margin-top: 10px;
            header: html_repeatingHeader;
        }

        /* keep the first page unchanged */
        @page :first {
            margin: 0%;
            header: none;
        }

        .pdf-repeat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px 10px 40px;
            border-bottom: 1px solid #ffb137;
        }

        .pdf-repeat-header .repeat-invoice {
            color: #ffb137;
            font-size: 20px;
            font-weight: 700;
        }

        .pdf-repeat-header .repeat-logo img {
            max-height: 70px;
            object-fit: contain;
        }

        .first_section {
            width: 100%;
            display: flex;
        }

        .logo_area {
            width: 30%;
            float: left;
            background: #ffb137;
            padding-top: 30px;
            text-align: center;
            height: 220px;
            padding-bottom: 40px;
        }

        .logo_image {
            width: 100px;
            padding-bottom: 5px;
        }

        .logo_area p {
            color: #fff;
        }

        .heading_area {
            text-align: right;

            width: 70%;
            float: right;
        }

        .heading_area p {
            color: #ffb137;
            font-size: 40px;
            padding: 0;
            margin: 0;
            font-weight: 700;
        }


        .heading_area .i_title {
            margin-top: 20px;
            padding-right: 15px;
        }

        .i_sub_title {
            display: flex;
            justify-content: space-between;
            padding-top: 5px;
        }

        .a {
            text-align: left;
        }

        .a p {
            font-weight: 700;
            font-size: 17px;
        }

        .b p {
            font-weight: 400;
            font-size: 15px;
            padding-top: 2px;
        }

        .table1 tbody tr {
            border-top: 1px solid #C4C4C4;
        }

        .second_section {
            background: #F2F2F2;
        }

        .d {
            padding: 5px;
            /* margin: 0px 50px; */
            /* border-bottom: 1px solid #FFFFFF; */
            color: #FFF;
            text-align: center;
            line-height: 24px;
            font-size: 18px;
            padding-bottom: 36px;
        }

        .d h5 {
            font-size: 18px;
            text-align: center;
            /* border-bottom: 2px solid white; */
            padding: 8px 0;
        }

        .e {
            margin-left: 10%;
        }

        .e h1 {
            font-size: 30px;
            padding: 40px 0px;
        }

        .empty_div {
            width: 25%;
            float: left;
        }

        .table_div {
            width: 75%;
            float: right;
            text-align: right;
            padding-right: 57px;
        }

        .flex {
            display: flex;
            justify-content: center;
            width: 100%
        }



        .signature_div {
            width: 30%;
            float: right;
            justify-content: center;
        }

        .invoice_body {
            border: 1px solid rgb(209, 209, 209);

        }
    </style>
    <htmlpageheader name="repeatingHeader">
        <div class="pdf-repeat-header">
            <div class="repeat-invoice">Invoice: {{ $invoiceData->invoice_id }}</div>
            @if ($userInvoiceLogo->invoice_logo != '')
                <div class="repeat-logo">
                    <img src="{{ public_path('storage/invoice/logo/' . $userInvoiceLogo->invoice_logo) }}" alt="Logo">
                </div>
            @endif
        </div>
    </htmlpageheader>
    <title>Billto.io</title>
</head>

<body>
    <div class="invoice_body page">
        <section class="first_section">
            <div class="logo_area">
                @if ($userInvoiceLogo->invoice_logo != '')
                    <img class="logo_image" style="object-fit: contain;"
                        src="{{ public_path('storage/invoice/logo/' . $userInvoiceLogo->invoice_logo) }}"
                        alt="img">
                @endif
                <p style=" font-size:20px; padding:12px;text-align: center; ">{{ $invoiceData->invoice_form }} </p>
            </div>

            <div class="heading_area" style="color: #686868;">
                <div class="i_title">
                    <p style=" margin-right:40px; margin-top:30px;margin-bottom:10px;">{{ __('messages.INVOICE') }} </p>
                </div>
                <table style="width:100%;  margin-right:-5px; ">
                    <tr>
                        <td style=""></td>
                        <td style="text-align:left; color:#686868; font-size:16px; ">{{ __('messages.INVOICE_no') }}#
                        </td>
                        <td style="text-align: right; font-size:16px; color:#686868; "> {{ $invoiceData->invoice_id }}
                        </td>
                    </tr>

                    <tr>
                        <th style="width: 35%"></th>
                        <td style="text-align:left; color:#686868; font-size:16px; width: 25%">
                            {{ __('messages.Invoice_Date') }}</td>
                        <td style="text-align: right; color:#686868; font-size:16px; width: 30%">
                            {{ $invoiceData->invoice_date }}
                        </td>
                        <th style="width: 10%"></th>
                    </tr>
                    <tr>
                        <td style="width: 35%"></td>
                        <td style=" text-align: left;  color:#686868; font-size:16px; width: 25%">
                            {{ __('messages.P.O.') }}#</td>
                        <td style="text-align: right; color:#686868; font-size:16px;  width: 30%">
                            {{ $invoiceData->invoice_po_number }}</td>
                        <td style="width: 10%"></td>
                    </tr>
                    <tr>
                        <td style="width: 35%"></td>
                        <td style="text-align: left;  color:#686868; font-size:16px; width: 25%">
                            {{ __('messages.Due_Date') }}</td>
                        <td style="text-align: right; color:#686868; font-size:16px; width: 30%">
                            {{ $invoiceData->invoice_dou_date }}
                        <td style="width: 10%"></td>
                </table>
            </div>
        </section>
        <section class="second_section">
            <div class="table">
                <div style="margin-left: 50px; margin-right:50px; height:250px;  ">
                    <table class="table1" style="width:100%;   border-collapse: collapse;">
                        <thead>
                            <tr>

                                <th
                                    style=" border-bottom: 1px solid #C4C4C4;  text-align:left; width:45%;font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;  padding-right: 0px;">
                                    {{ __('messages.description') }} </th>
                                <th
                                    style="  border-bottom: 1px solid #C4C4C4;  text-align:left; width:15%; font-weight: 700; font-size: 17px; line-height: 29px; text-transform: uppercase; color: #686868;  padding-right: 0px;">
                                    {{ __('messages.qty') }} </th>
                                <th
                                    style=" border-bottom: 1px solid #C4C4C4;  text-align:right; width:20%; font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;  padding-right: 0px;">
                                    {{ __('messages.unit_price') }} </th>
                                <th
                                    style=" border-bottom: 1px solid #C4C4C4;  text-align:right; width:20%;font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;  padding-right: 0px;">
                                    {{ __('messages.amount') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productsDatas as $product_detail)
                                <tr>

                                    <td
                                        style=" text-align:left; width:45%;border-bottom: 1px solid #C4C4C4; font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_name }}</td>
                                    <td
                                        style=" padding:6px 0px; text-align:left; width:15%; border-bottom: 1px solid #C4C4C4;  font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_quantity }}</td>
                                    <td
                                        style="  width:20%;border-bottom: 1px solid #C4C4C4;  font-size: 16px; color: #686868; text-align:right; ">
                                        {{ number_format($product_detail->product_rate, 2) }}</td>
                                    <td
                                        style="  width:20%; border-bottom: 1px solid #C4C4C4; font-size: 16px; color: #686868; text-align:right; ">
                                        {{ number_format($product_detail->product_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:300px; margin-top:80px;">
                <table style="width: 100%;  border-top:2px solid #ffb137;margin-right:50px; ">
                    <tr style="text-align: right;">
                        <td></td>
                        <td style="color: #686868; "> {{ __('messages.Subtotal') }} </td>
                        <td style="color: #686868; text-align:right; font-size:16px;">
                            {{ number_format($subtotal = $invoiceData->subtotal_no_vat, 2) }}
                        </td>
                    </tr>
                    <tr style="text-align: right">
                        <td></td>
                        <td style="color: #686868; "> {{ __('messages.Sales_Tax') }}
                            ({{ $tax = $invoiceData->invoice_tax_percent }}%)</td>
                        <td style="color: #686868;text-align:right; font-size:16px;">
                            {{ number_format($tax_value = ($subtotal * $tax) / 100, 2) }}</td>
                    </tr>
                    <tr style="text-align: right">
                        <td></td>
                        <td style="color: #686868; ">{{ __('messages.Discount_Amount') }}
                            ({{ $tax = $invoiceData->discount_percent }}%)
                        </td>
                        <td style="color: #686868; text-align:right; font-size:16px;">
                            {{ number_format($invoiceData->discount_amounts, 2) }}</td>
                    </tr>
                    <tr style="text-align: right">
                        <td></td>
                        <td style="color: #686868; "> {{ __('messages.Receive_Advance_Amount') }}
                            ({{ $invoiceData->currency }})</td>
                        <td style="color: #686868;text-align:right; font-size:16px;">
                            {{ number_format($invoiceData->receive_advance_amount, 2) }}</td>
                    </tr>
                    <tr style="text-align: right">
                        <td></td>
                        <td style="color: #686868;">{{ __('messages.Requesting_Advance_Amount') }}
                            ({{ $invoiceData->requesting_advance_amount_percent }}%)</td>
                        <td style="color: #686868; text-align:right; font-size:16px;">
                            {{ number_format(($invoiceData->final_total * $invoiceData->requesting_advance_amount_percent) / 100, 2) }}
                        </td>
                    </tr>
                    <tr style="text-align: right">
                        <td></td>
                        <td style="font-size: 18px; color: #686868;">{{ __('messages.Total') }} </td>
                        <td style="font-size: 18px; color: #686868; text-align:right; ">
                            {{ $invoiceData->currency }}
                            {{ number_format($invoiceData->final_total - $invoiceData->receive_advance_amount, 2) }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <style>
            .border {
                border-bottom: 2px solid #FFF;
            }

            .third_section {
                width: 100%;
                display: flex;
            }

            .left_Side_bar {
                width: 30%;
                background-color: #ffb137;
                float: left;
                height: 280px;
                padding-bottom: 30px;
            }

            .third_sectionc {
                padding: 10px;
                color: #fff;
                font-size: 14px;
                text-align: justify;
            }

            .third_sectionc h5 {
                font-size: 18px;
                text-align: center;

            }

            .right_Side_bar {
                width: 70%;
                float: right;
            }

            .terms_condition_div {
                width: 70%;
                float: left;

            }

            .last_section {
                width: 100%;
                display: flex;
            }

            .left_terms_condition {
                width: 80%;
                float: left;
                padding-left: 10px;

            }

            .right_terms_condition {
                float: right;
                margin-top: 60px;
            }
        </style>
        <section class="third_section">
            <div class="left_Side_bar" style=" background-color: #ffb137">
                <div class="third_sectionc">
                    <h5>{{ __('messages.To_send') }}</h5>
                    <div class="border"></div>
                    <p style="padding:12px;text-align: center; font-size:20px;">{{ $invoiceData->invoice_to }}</p>
                </div>
            </div>
            <div class="right_Side_bar">
                <h5 style="color: #686868; font-size: 24px;  width:90%; padding-left:10px;">
                    {{ __('messages.Thank_You_for_your_business') }}</h5>
                <div class="last_section">
                    <div class="left_terms_condition">
                        <p style="font-size: 16px; color: #ffb137; text-transform: uppercase;">
                            {{ __('messages.Terms_&_conditions') }} </p>
                        <p style="font-size:16px; color:#686868;"> {{ $userInvoiceLogo->terms }}</p>
                        <p style=" font-size:16px; color:red;"> {{ $invoiceData->invoice_notes }}</p>
                    </div>
                    <div class="right_terms_condition">
                        @if ($userInvoiceLogo->signature != '')
                            <img style="width: 80px; height:80px; object-fit:contain;"
                                src="{{ public_path('uploads/signature/' . $userInvoiceLogo->signature) }}"
                                alt="img">
                        @endif
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>

</body>

</html>
