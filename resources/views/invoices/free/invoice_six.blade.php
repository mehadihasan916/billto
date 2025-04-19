<style>
    * {
        padding: 0;
        margin: 0;
    }


    .first_section {
        width: 100%;
        display: flex;
    }

    .textHeading {
        color: #FFF;
        line-height: 24px;
        font-size: 16px;
        margin-left: 65px;
        margin-top: 27px;
        margin-bottom: 39px
    }

    .logo_area img {
        width: 100px;
    }

    .logo_area {
        width: 30%;
        float: left;
        text-align: start;
    }

    .logo_area p {
        color: #FFF;
    }

    .heading_area {
        text-align: right;
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
</style>
<title>Billto.io</title>


</head>

<body>
    <div class="invoice_body page" size="A4" style="">
        <section class="first_section" style="height: 140px; width:800px; background-color: #414141;">
            <div class="logo_area">
                <div class="textHeading">
                    <p><b>Company Name </b></p>
                    <p>123 Rockfeller Street,</p>
                    <p>New York, NY 12210</p>
                </div>
            </div>
            <div class="heading_area" style="color: #686868;">
                <div>
                    @if($invoiceData->invoice_logo!="")
                    <img src="{{ public_path('storage/invoice/logo/' . $invoiceData->invoice_logo) }}" alt="img"
                        style="width: 90px; height:90px; margin-top:20px; margin-right: 74px;border-radius: 25px;">
                     @endif
                </div>
            </div>
        </section>
        <div class="heading_area" style="border: 1px solid red; height: 10px">
            <h1>INVOICE</h1>
        </div>
        <style>
            .border {
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
                            <tr>
                                <td class="border"
                                    style="border-left:none; border-top:none; border-right:none; padding:10px 0px; padding-left:5px; text-align:left; width:20%;  font-weight: 400; font-size: 16px; color: #686868; ">
                                    01</td>
                                <td class="border"
                                    style=" border-top:none; border-right:none; padding-left:10px; text-align:left; width:40%;font-weight: 400; font-size: 16px; color: #686868; ">
                                    Front and rear brake cable</td>
                                <td class="border"
                                    style="border-top:none; border-right:none; padding-right:20px;  width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
                                    1,00.00</td>
                                <td class="border"
                                    style="border-top:none; border-right:none; padding-right:20px; width:20%; font-weight: 400; font-size: 16px; color: #686868; text-align:right; ">
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
                            </tr>
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
                    <div style="margin-top: 0; width:100%; display:flex;">
                        <div class="empty_div">
                            <ul style="background: #039DBF; ">
                                <li>Subtotal</li>
                                <li>Sales Tax 6.25%</li>
                                <li>Total</li>
                            </ul>
                        </div>
                        <div class="table_div" style="background: #F2F2F2;">
                            <ul>
                                <li>300.00 </li>
                                <li>20.00</li>
                                <li>320.00</li>
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
                        <h5
                            style="color: #686868; font-weight: 400; font-size: 30px; padding-bottom:20px; border-top:2px solid #0370BF; width: 80%">
                            Thank You for your business</h5>
                    </div>
                    <div class="g" style="color: #686868;">
                        <p style="font-weight: 700;font-size: 14px;color: #0370BF; text-transform: uppercase;">terms &
                            conditions</p>
                        <p>Payment is due within 15 days</p>
                        <p>Please make checks payable to: Company Name</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
