{{-- three invoice --}}
<style>
    * {
        padding: 0;
        margin: 0;
    }

    /* start frist sec  */
    .first_section {
        width: 100%;
        display: flex;
        /* margin-top:100px; */
        /* position: relative; */
        /* z-index: 2; */

    }

    .leftSideArea {
        float: left;
        width: 40%
    }

    .rightSideArea {
        float: right;
        width: 60%

    }

    /* end frist serction  */
    .second_section {
        padding-top: 20px;
        padding-bottom: 80px;

    }

    .third_section {
        width: 100%;
        display: flex;

    }

    .left_Side_bar {
        width: 30%;
        background-color: #0370BF;
        padding-top: 20px;
        padding-bottom: 20px;
        float: left;
    }



    .c {
        padding: 5px;
        color: #FFF;
        line-height: 24px;
        font-size: 16px;
        padding-bottom: 20px;
    }


    .d {
        padding: 5px;
        color: #FFF;
        line-height: 24px;
        font-size: 16px;
        padding-bottom: 40px;
    }


    .margin_left_terms {
        margin-left: 10%;
    }

    .empty_div {
        width: 25%;
        float: left;
    }

    .table_div {
        width: 75%;
        float: right;
        text-align: right;
        /* border-top: 2px solid #FCB21C; */
        padding-right: 20px;
    }

    .page {
        background: var(--white);
        display: block;
        margin: 0 auto;
        position: relative;
        box-shadow: var(--pageShadow);
    }

    .page[size="A4"] {
        width: 21cm;
        min-height: 29.7cm;
        overflow: hidden;
    }
    .termsFelx{
        display: flex;
        width: 100%;
    }
    .termsAndConditionDiv{
        float: left;
        width: 65%;
    }
    .signature_div{
        float: right;
        width: 35%
            }
</style>
<title>Billto.io</title>


</head>

<body>


    <div class="invoice_body page" size="A4"
        style="background: url('assets/vector-invoice/vector1.png');background-repeat:no-repeat">
        <section>
            <div class="first_section">
                <div class="leftSideArea" >
                    <div class="logo_area" style="margin-left:50px;">
                        <div class="c">
                            <p style="font-size: 20px; padding-top:15px"><b>{{ $invoiceData->invoice_form }} </b></p>
                        </div>
                        <div class="c">
                            <h5>To</h5>
                            <p><b>{{ $invoiceData->invoice_to }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="rightSideArea">
                        <div style="text-align:right; margin-right:89px; margin-top:25px">
                            @if ($userInvoiceLogo->invoice_logo != '')
                                <img style="object-fit: contain;" src="{{ public_path('storage/invoice/logo/' . $userInvoiceLogo->invoice_logo) }}"
                                    alt="img" style="width: 80px; height:80px;">
                            @endif
                            <h1 style="font-size:40px; color:#039DBF; margin-top:30px;margin-left:2px">INVOICE</h1>
                        </div>
                        <div class="" style="color: #686868; margin-top:30px;margin-left:6px">
                            <table style="padding-left:123px; ">
                                <tr>
                                    <th style="text-align:left; font-size:18px;">Incoice #</th>
                                    <th style="text-align: right;font-size:18px; padding-left:95px;">
                                        {{ $invoiceData->invoice_id }}</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left; font-size:18px;">Invoice Date</th>
                                    <td style="text-align: right; font-size:18px;">{{ $invoiceData->invoice_date }}</td>
                                </tr>
                                <tr>
                                    <th style=" text-align: left; font-size:18px;">P.O.#</th>
                                    <td style="text-align: right; font-size:18px;">{{ $invoiceData->invoice_po_number }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; font-size:18px;">Due Date</th>
                                    <td style="text-align: right; font-size:18px;">{{ $invoiceData->invoice_dou_date }}
                            </table>
                        </div>
                </div>
            </div>
        </section>

        <style>
            .border {
                border-left: 1px solid #FFF;
                border-right: 1px solid #FFF;
                border-bottom: 1px solid rgb(255, 255, 255);
                border-top: 1px solid #FFF;
            }
        </style>
        <section class="second_section" style="margin-top:240px">
            <div class="table">
                <div style="min-height:380px; margin-left: 50px; margin-right:60px; padding-top:80px; padding-bottom:80px;">
                    <table class="table1 border" style="width:100%; background:#F2F2F2;">
                        <thead>
                            <tr style="padding-left:200px !important;">
                                <th class="border"
                                    style="border-left:none; border-top:none; border-right:none; padding-left:5px; text-align:left; width:20%; font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    qty</th>
                                <th class="border"
                                    style="border-top:none; border-right:none; padding-left:10px; text-align:left; width:40%;font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    description</th>
                                <th class="border"
                                    style="border-top:none; border-right:none; padding-right:20px; text-align:right; width:20%; font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    unit price</th>
                                <th class="border"
                                    style="border-top:none; border-right:none; padding-right:20px; text-align:right; width:20%;font-weight: 700; font-size: 17px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productsDatas as $product_detail)
                                <tr>
                                    <td class="border"
                                        style="border-left:none; border-top:none; border-right:none; padding:6px 0px; padding-left:5px; text-align:left; width:20%;  font-weight: 400; font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_quantity }}</td>
                                    <td class="border"
                                        style=" border-top:none; border-right:none; padding-left:10px; text-align:left; width:40%;font-weight: 400; font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_name }}</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px;  width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        {{ number_format($product_detail->product_rate, 2) }}</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        {{ number_format($product_detail->product_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <style>
                        .empty_div ul li {
                            list-style-type: none;
                            padding: 10px;

                        }

                        .table_div ul li {
                            list-style-type: none;
                            padding: 10px;

                        }

                        .empty_div {
                            margin-left: 410px;
                            width: 135px;
                        }

                        .table_div {
                            width: 118px;
                        }
                    </style>
                    {{-- <div style="margin-top: 0; width:100%; display:flex;">
                        <div class="empty_div">
                            <ul style="background: #039DBF; ">
                                <li>Subtotal</li>
                                <li>Sales Tax {{ $tax = $invoiceData->invoice_tax_percent }}% </li>
                                <li>Discount Amount</li>
                                <li>Receive Advance Amount</li>
                                <li>Requesting Advance Amount</li>
                                <li>Total</li>
                            </ul>
                        </div>
                        <div class="table_div" style="background: #F2F2F2;">
                            <ul>
                                <li>{{ number_format($subtotal = $invoiceData->subtotal_no_vat, 2) }} </li>
                                <li> {{ number_format($tax_value = ($subtotal * $tax) / 100, 2) }}</li>
                                <li>{{ number_format($invoiceData->discount_amounts,2) }}</li>
                                <li>{{ number_format($invoiceData->receive_advance_amount,2) }}</li>
                                <li>{{ number_format(($invoiceData->final_total * $invoiceData->requesting_advance_amount_percent) / 100, 2) }}</li>
                                <li>{{ $invoiceData->currency }}  {{ number_format($invoiceData->final_total- $invoiceData->receive_advance_amount, 2) }}</li>
                            </ul>
                        </div>
                    </div> --}}
                    <div style=" width:55%; margin-left: 310px;">
                        <table style="width: 100%; ">
                            <tr style="text-align: right; ">
                                <td style="color:white; background:#039DBF">Subtotal</td>
                                <td style="color: #686868; background: #F2F2F2;padding-right:25px">{{ number_format($subtotal = $invoiceData->subtotal_no_vat, 2) }}
                                </td>
                            </tr>
                            <tr style="text-align: right">
                                <td style="color: white; background:#039DBF">Sales Tax  ({{ $tax = $invoiceData->invoice_tax_percent }}%)</td>
                                <td style="color: #686868; background: #F2F2F2;padding-right:25px"> {{ number_format($tax_value = ($subtotal * $tax) / 100, 2) }}</td>
                            </tr>
                            <tr style="text-align: right">
                                <td style="color: white;background:#039DBF ">Discount Amount  ({{ $tax = $invoiceData->discount_percent }}%)</td>
                                <td style="color: #686868; background:#F2F2F2;padding-right:25px"> {{ number_format($invoiceData->discount_amounts,2) }}</td>
                            </tr>
                            <tr style="text-align: right">
                                <td style="color: white; background:#039DBF">Receive Advance Amount({{ $invoiceData->currency }})</td>
                                <td style="color: #686868; background:#F2F2F2;padding-right:25px"> {{ number_format($invoiceData->receive_advance_amount,2) }}</td>
                            </tr>
                            <tr style="text-align: right">
                                <td style="color: white; background:#039DBF">Requesting Advance Amount({{ $invoiceData->requesting_advance_amount_percent }}%)</td>
                                <td style="color: #686868; background:#F2F2F2;padding-right:25px"> {{ number_format(($invoiceData->final_total * $invoiceData->requesting_advance_amount_percent) / 100, 2) }}</td>
                            </tr>
                            <tr style="text-align: right">
                                <td style="font-size: 18px; color:white; padding-left:80px; background:#039DBF">Total</td>
                                <td style="font-size: 18px; color: #686868; background:#F2F2F2;padding-right:25px">
                                    {{ $invoiceData->currency }}  {{ number_format($invoiceData->final_total- $invoiceData->receive_advance_amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="third_section">

            <div class="right_Side_bar ">

                <div class="margin_left_terms">
                    <div class="thanks" style="padding-top: 50px;">
                        <h5
                            style="color: #686868; font-weight: 400; font-size: 25px; padding-bottom:20px;  width: 80%">
                            Thank You for your business</h5>
                    </div>
                    <div class="termsFelx">
                        <div class="termsAndConditionDiv" style="color: #686868;">
                            <p style="padding-bottom:15px; font-weight: 700;font-size: 14px;color: #0370BF; text-transform: uppercase;">terms &
                                conditions</p>
                            <p  style="padding-bottom:15px">{{  $userInvoiceLogo->terms }}</p>
                            <p>{{  $invoiceData->invoice_notes }}</p>
                        </div>
                        <div class="signature_div">
                            @if ($userInvoiceLogo->signature != '')
                            <img style="object-fit:contain;" style="width: 100px; height:100px "
                                src="{{ public_path('uploads/signature/' . $userInvoiceLogo->signature) }}"
                                alt="img">
                        @endif
                        </div>
                    </div>

                </div>
            </div>

    </div>
    </section>
    </div>

    </div>
