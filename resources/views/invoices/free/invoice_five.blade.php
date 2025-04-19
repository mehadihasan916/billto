<style>
    * {
        padding: 0;
        margin: 0;
    }

    .first_section {
        width: 100%;
        display: flex;
        margin-bottom: 10px;
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
        /* padding-bottom:100px; */
        /* text-align: left; */
        text-align: start;
    }
    .logo_area  p{
        color: #FFF;
    }

    .heading_area {
        text-align: right;
        /* padding-top: 50px; */
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
        padding-top: 30px;
        padding-bottom: 30px;
        margin-left: 300px;
        /* margin-right: 200px;      */
    }

    .a {
        text-align: left;
    }

    .a p {
        font-weight: 700;
        font-size: 20px;
    }

    .b p {
        font-weight: 400;
        font-size: 18px;
        padding-top: 2px;
    }



    .second_section {
        margin-top: -40px;
        padding-bottom: 80px;

    }

    .third_section {
                width: 100%;
                display: flex;

            }



            .c {
                /* padding: 5px; */
                padding-bottom: 20px;
                width: 30%;
                float: left;
                margin-left:200px;
            }

            .c h5{
                font-weight: 700;
                font-size: 19px;
                text-transform: uppercase;
                color: #A950A0;
                /* border-bottom: 2px solid #A950A0; */
                /* width: 35%; */
            }

            .c p{
                color: #686868;
                font-weight: 400;
                font-size: 17px;
            }
            .d {
                /* padding: 5px; */
                padding-bottom: 20px;
                width: 30%;
                float: left;
            }
            .d h5{
                font-weight: 700;
                font-size: 19px;
                text-transform: uppercase;
                color: #A950A0;
                border-bottom: 2px solid #A950A0;
                width: 65%;
            }
            .d p{
                color: #686868;
                font-weight: 400;
                font-size: 17px;
            }
            .contact h5{
                font-weight: 700;
                font-size: 24px;
                /* text-transform: uppercase; */
                color: #A950A0;
                /* border-bottom: 2px solid #A950A0; */
                width: 20%;
            }
            .contact p{
                color: #686868;
                font-weight: 400;
                font-size: 17px;
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
            .contact{
                /* width: 50%; */
            }
</style>

<title>Billto.io</title>

<body>

    <div class="invoice_body page" size="A4" style="background: url('assets/vector-invoice/vector2.png') no-repeat scroll;">
        <section class="first_section">
            <div class="logo_area" style="margin-left:50px;">
                @if($invoiceData->invoice_logo!="")
                <img src="{{ public_path('storage/invoice/logo/'.$invoiceData->invoice_logo) }}" alt="img" style="width: 70px">
                @endif
            </div>
            <div class="heading_area" style="color: #686868;">
                <div class="i_title" ">
                    <img src="assets/vector-invoice/invoice.png" alt="">
                </div>
                <div class="i_sub_title" style="width: 60%;">
                    <div class="a">
                        <p>Incoice #</p>
                        <p>invoice date</p>
                        <p>p.o.#</p>
                        <p>due date</p>
                    </div>
                    <div class="b">
                        <p>{{ $invoiceData->invoice_id }}</p>
                        <p>{{  $invoiceData->invoice_date }}</p>
                        <p>{{ $invoiceData->invoice_po_number }}</p>
                        <p>{{  $invoiceData->invoice_dou_date }}</p>
                    </div>
                </div>
                {{-- <div class="contact" style="width: 40%;">
                    <h5>Company Name</h5>
                    <p>123 Rockfeller Street,</p>
                    <p>New York, NY 12210</p>
                </div> --}}

            </div>
        </section>
        <style>
            .add_section{
                display: flex;
                width: 100%;
                margin-bottom:200px;
                margin-left:-95px;            }

        </style>
        <section>
            <div class="add_section" style="display:flex;">
                {{-- <div class="contact">
                    <h5>Company Name</h5>
                    <p>123 Rockfeller Street,</p>
                    <p>New York, NY 12210</p>
                </div> --}}
                <div class="c">
                    <h5>Company Name</h5>
                    <p>{{ $invoiceData->invoice_form }}</p>
                    {{-- <p>New York, NY 12210</p> --}}
                    {{-- <h5>To</h5>
                    <p ><b>New York, NY 12210</b></p>
                    <p>123 Rockfeller Street,</p>
                    <p>New York, NY 12210</p> --}}
                </div>
                <div class="d">
                    <h5> To</h5>
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
                <div style="margin-left: 150px; margin-right:60px; padding-bottom:80px;">
                    <table class="table1 " style="width:100%; background:#F2F2F2;">
                        <thead>
                            <tr style="padding-left:200px !important;">
                                <th class=""
                                    style="border-left:none;   padding-left:5px; text-align:left; width:20%; font-weight: 700; font-size: 18px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    qty</th>
                                <th class=""
                                    style="  padding-left:10px; text-align:left; width:40%;font-weight: 700; font-size: 18px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    description</th>
                                <th class=""
                                    style="  padding-right:20px; text-align:right; width:20%; font-weight: 700; font-size: 18px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    unit price</th>
                                <th class=""
                                    style="  padding-right:20px; text-align:right; width:20%;font-weight: 700; font-size: 18px; line-height: 29px;text-transform: uppercase; color: #686868;">
                                    amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productsDatas as $product_detail)
                            <tr style="background: #FFF;">
                                <td class=""
                                    style="   padding:10px 0px; padding-left:5px; text-align:left; width:20%;  font-weight: 400; font-size: 18px; color: #686868; ">
                                    {{ $product_detail->product_quantity }}</td>
                                <td class=""
                                    style="   padding-left:10px; text-align:left; width:40%;font-weight: 400; font-size: 18px; color: #686868; ">
                                    {{ $product_detail->product_name }}</td>
                                <td class=""
                                    style="  padding-right:20px;  width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    {{ number_format($product_detail->product_rate,2) }}</td>
                                <td class=""
                                    style="  padding-right:20px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    {{number_format( $product_detail->product_amount,2)}}</td>
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td class=""
                                    style="   padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 18px; color: #686868; ">
                                    01</td>
                                <td class=""
                                    style="  padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 18px; color: #686868; ">
                                    Front and rear brake cable</td>
                                <td class=""
                                    style="  padding-right:20px; padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                                <td class=""
                                    style="  padding-right:20px; padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                            </tr>
                            <tr style="background: #FFF;">
                                <td class=""
                                    style="   padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 18px; color: #686868; ">
                                    01</td>
                                <td class=""
                                    style="  padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 18px; color: #686868; ">
                                    Front and rear brake cable</td>
                                <td class=""
                                    style="  padding-right:20px; padding-top:10px; padding-bottom:10px;  width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                                <td class=""
                                    style="  padding-right:20px;padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                            </tr>
                            <tr>
                                <td class=""
                                    style="   padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 18px; color: #686868; ">
                                    01</td>
                                <td class=""
                                    style="  padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 18px; color: #686868; ">
                                    Front and rear brake cable</td>
                                <td class=""
                                    style="  padding-right:20px; padding-top:10px; padding-bottom:10px;  width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                                <td class=""
                                    style="  padding-right:20px;padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                            </tr>
                            <tr style="background: #FFF;">
                                <td class=""
                                    style="   padding-left:5px; padding-top:10px; padding-bottom:10px; text-align:left; width:20%;  font-weight: 400; font-size: 18px; color: #686868; ">
                                    01</td>
                                <td class=""
                                    style="  padding-left:10px; padding-top:10px; padding-bottom:10px; text-align:left; width:40%;font-weight: 400; font-size: 18px; color: #686868; ">
                                    Front and rear brake cable</td>
                                <td class=""
                                    style="  padding-right:20px; padding-top:10px; padding-bottom:10px;  width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                                <td class=""
                                    style="  padding-right:20px;padding-top:10px; padding-bottom:10px; width:20%; font-weight: 400; font-size: 18px; color: #686868; text-align:right; ">
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
                            margin-left: 330px;
                            width: 135px;

                        }
                        .table_div{
                            width: 100px;
                        }
                    </style>
                    <div style="margin-top: 80px; width:100%; display:flex; border-top:2px solid #A950A0; color:#686868">
                        <div class="empty_div">
                            <ul>
                                <li>Subtotal</li>
                                <li>Sales Tax  {{$tax = $invoiceData->invoice_tax_percent }}%</li>
                                <li style="background: #A950A0; color:#fff;">Total</li>
                            </ul>
                        </div>
                        <div class="table_div" >
                            <ul>
                                <li>{{ number_format($subtotal = $invoiceData->total,2) }} </li>
                                <li>{{number_format( $tax_value =  $subtotal*$tax /100,2) }}</li>
                                <li style="background: #A950A0; color:#fff;">{{  number_format($subtotal + $tax_value,2)  }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="third_section" style="margin-left:-50px;">

            <div class="right_Side_bar " style="margin-top:50px;">

                    <div class="f" style="display:flex;">
                        <div class="thanks" style="padding-top:;">
                            <h5 style="color: #686868; font-weight: 400; font-size: 30px; margin-bottom:-200px;  margin-left:300px; width: 80%">Thank You for your business</h5>
                        </div>
                        <div class="g" style="color: #FFF; width:200px;">
                            <p style="font-weight: 700;font-size: 14px; text-transform: uppercase;">terms & conditions</p>
                            <p>{{  $invoiceData->invoice_terms }}</p>
                            <p>{{  $invoiceData->invoice_notes}}</p>
                        </div>

                    </div>
            </div>

    </div>
    </section>
    </div>

    </div>
