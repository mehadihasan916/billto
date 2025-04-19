
    {{-- four invoice  --}}

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .first_section {
            width: 100%;
            display: flex;
            margin-bottom: 75px;
            justify-content: space-between;

            /* position: relative; */
            /* z-index: 2; */

        }


        .logo_area img {
            width: 100px;
            padding-bottom:5px;
        }

        .logo_area {
            width: 30%;
            float: left;
            padding-top: 50px;
            padding-bottom:100px;
            /* text-align: left; */
            text-align: start;
        }
        .logo_area  p{
            color: #FFF;
        }

        .heading_area {
            text-align: right;
            padding-top: 50px;
            padding-bottom: 100px;
            padding-right: 50px;

        }

        .heading_area h1 {
            color: #FCB21C;
            font-weight: 700;
            font-size: 59.9879px;
            line-height: 73px;
        }

        .heading_area .a {
            width: 50%;
            float: left;
            text-align: left;
            margin-left: 30%;
        }

        .heading_area .b {
            width: 50%;
            float: right;
        }

        .heading_area .i_title {
            /* margin-top: 20px; */
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


                .f {
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
                            .page{
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

    </style>

    <title>Billto.io</title>

    <body>

        <div class="invoice_body page" size="A4" style="background: url('assets/vector-invoice/vector3.png') no-repeat scroll;">
            <section class="first_section">
                <div class="logo_area" style="margin-left:50px;">
                    <div class="c">
                        <p><b>Company Name </b></p>
                        <p>{{ $invoiceData->invoice_form }}</p>
                        {{-- <p>New York, NY 12210</p> --}}
                    </div>

                    <div class="c">
                        <h5>To</h5>
                        <p><b>{{   $invoiceData->invoice_to }}</b></p>
                        {{-- <p>123 Rockfeller Street,</p>
                        <p>New York, NY 12210</p> --}}
                    </div>
                    <div class="d">
                        <h5>Ship To</h5>
                        <p><b>Neals BD.</b></p>
                        <p>123 Rockfeller Street,</p>
                        <p>New York, NY 12210</p>
                    </div>

                </div>


                <div class="heading_area" style="color: #686868;">
                    <div class="i_logo" style="text-align: center;">

                    </div>
                    <div class="i_title">
                        @if($invoiceData->invoice_logo!="")
                         <img src="{{ public_path('storage/invoice/logo/'.$invoiceData->invoice_logo) }}" alt="img" style="width: 70px">
                        @endif
                         <h1>INVOICE</h1>
                    </div>
                    <div class="i_sub_title">
                        <div class="a">
                            <p>Incoice #</p>
                            <p>Invoice date</p>
                            <p>P.o.#</p>
                            <p>Due date</p>
                        </div>
                        <div class="b">
                            <p>{{ $invoiceData->invoice_id }}</p>
                            <p>{{  $invoiceData->invoice_date }}</p>
                            <p>{{ $invoiceData->invoice_po_number }}</p>
                            <p>{{  $invoiceData->invoice_dou_date }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <style>
                .border{
                    border-left: 1px solid #FFF;
                    border-right: 1px solid #FFF;
                    border-bottom: 1px solid rgb(255, 255, 255);
                    border-top: 1px solid #FFF;
                }
            </style>
            <section class="second_section">
                <div class="table">
                    <div style="margin-left: 50px; margin-right:60px; padding-top:80px; padding-bottom:80px;">
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
                                        style="border-left:none; border-top:none; border-right:none; padding:10px 0px; padding-left:5px; text-align:left; width:20%;  font-weight: 400; font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_quantity }}</td>
                                    <td class="border"
                                        style=" border-top:none; border-right:none; padding-left:10px; text-align:left; width:40%;font-weight: 400; font-size: 16px; color: #686868; ">
                                        {{ $product_detail->product_name }}</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px;  width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        {{ number_format($product_detail->product_rate,2) }}</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        {{number_format( $product_detail->product_amount,2)}}</td>
                                </tr>
                                @endforeach
                              {{--  <tr>
                                    <td class="border"
                                        style="border-left:none; border-top:none; border-right:none; padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 16px; color: #686868; ">
                                        01</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 16px; color: #686868; ">
                                        Front and rear brake cable</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px; padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        1,00.00</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px; padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        1,00.00</td>
                                </tr>
                                <tr>
                                    <td class="border"
                                        style="border-left:none; border-top:none; border-right:none; padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 16px; color: #686868; ">
                                        01</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 16px; color: #686868; ">
                                        Front and rear brake cable</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px; padding-top:10px; padding-bottom:10px;  width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        1,00.00</td>
                                    <td class="border"
                                        style="border-top:none; border-right:none; padding-right:20px;padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                        1,00.00</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <style>
                            .empty_div ul li{
                                list-style-type:none;
                                padding: 10px;

                            }
                            .table_div ul li{
                                list-style-type:none;
                                padding: 10px;

                            }
                            .empty_div{
                                margin-left: 410px;
                                width: 135px;
                            }
                            .table_div{
                                width: 118px;
                            }
                        </style>
                        <div style="margin-top: 0; width:100%; display:flex;">
                            <div class="empty_div">
                                <ul style="background: #039DBF; ">
                                    <li>Subtotal</li>
                                    <li>Sales Tax {{$tax = $invoiceData->invoice_tax_percent }}%</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="table_div" style="background: #F2F2F2;">
                                <ul>
                                    <li>{{ number_format($subtotal = $invoiceData->total,2) }} </li>
                                    <li>{{number_format( $tax_value =  $subtotal*$tax /100,2) }}</li>
                                    <li>{{  number_format($subtotal + $tax_value,2)  }}</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <section class="third_section">

                <div class="right_Side_bar ">

                        <div class="f">
                            <div class="thanks" style="padding-top: 20%;">
                                <h5 style="color: #686868; font-weight: 400; font-size: 30px; padding-bottom:20px; border-top:2px solid #0370BF; width: 80%">Thank You for your business</h5>
                            </div>
                            <div class="g" style="color: #686868;">
                                <p style="font-weight: 700;font-size: 14px;color: #0370BF; text-transform: uppercase;">Terms & conditions</p>
                                <p>{{  $invoiceData->invoice_terms }}</p>
                                <p>{{  $invoiceData->invoice_notes}}</p>
                            </div>
                        </div>
                </div>

        </div>
        </section>
        </div>

        </div>


