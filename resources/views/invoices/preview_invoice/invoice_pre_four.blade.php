<style>
    .page {
        width: 21cm;
        min-height: 29.7cm;
        overflow: hidden;
        margin: 0 auto;
        background-color: #fffffff3;
    }



    .footer h1 {
        color: aliceblue;
    }

    .to,
    .ship_to {
        color: #A950A0;
        border-bottom: 1.3px solid #A950A0;
    }
</style>
<div class="page"
    style="background-image:  url('{{ asset('assets/vector-invoice/group_sape.png') }}');
background-repeat: no-repeat;
background-size: 300px 1140px;
">
    <div class="row border">
        <section class="col-3">
            <div class="">
                <img src="./img/logowid.png" alt="" style="width:120px; margin-left:40px; margin-top:20px;">
            </div>
            <div class="footer" style="padding: 20px;">
                <h6 style="color: #ffffff; font-weight: 600; padding-top: 20cm;">
                    TERMS & CONDITIONS </h6>
                <span style="color: #ffffff; font-size: 14px;">Payment is due within 15 days<br>
                    Please make checks payable <br>to: Company Name</span>
            </div>
        </section>

        <section class="col-9" style="padding-left: 30px; padding-right: 60px;">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <h1 style="background-color: #A950A0;
          color: #ffffff; padding:10px;">INVOICE</h1>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-5 my-3">
                    <h3>Company Name</h3>
                    <p>123 Rockfeller Street,<br>New York, NY 12210</p>
                </div>
                <div class="col-4">
                    <h5>
                        INVOICE# <br>INVOICE DATE<br>P.O.#<br>DUE DATE
                    </h5>
                </div>
                <div class="col-3 text-end">
                    10201<br>11/02/2022<br>12/11/2022<br>27/01/2022</div>
            </div>

            <div class="row">
                <div class="col-5">
                    <div class="to">
                        <h5>TO</h5>
                    </div>
                    <div class="to_text">
                        <p>
                            Neals BD.<br>123 Rockfeller Street,<br>New York, NY 12210
                        </p>
                    </div>
                </div>

                <div class="col-5">
                    <div class="ship_to">
                        <h5>SHIP TO</h5>
                    </div>
                    <div class="to_text">
                        <p>
                            Neals BD.<br>123 Rockfeller Street,<br>New York, NY 12210
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <table class="">
                    <thead>
                        <tr style="background-color: #F2F2F2; margin: 20px; height: 47px;">
                            <th scope="col" style="padding-left: 20px;">QTY</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">UNIT PRICE</th>
                            <th scope="col">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">1</th>
                            <td> Front and rear brake cable</td>
                            <td> 1,00.00</td>
                            <td> 1,00.00</td>
                        </tr>
                        <tr style="background-color: #F2F2F2; margin: 20px; height: 47px;">
                            <th scope="row" style="padding-left: 20px;">1</th>
                            <td> Front and rear brake cable</td>
                            <td scope="col"> 1,00.00</td>
                            <td scope="col"> 1,00.00</td>
                        </tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">1</th>
                            <td> Front and rear brake cable</td>
                            <td> 1,00.00</td>
                            <td> 1,00.00</td>
                        </tr>
                        <tr style="background-color: #F2F2F2; margin: 20px; height: 47px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row" style="margin-top:100px;">
                <hr style="width: 100%; color: #A950A0; height: 2px; background-color:#A950A0;" />
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="col-6"></div>
                        <div class="col-3 d-flex justify-content-end">Subtotal</div>
                        <div class="col-3 d-flex justify-content-end">300.00</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="col-3"></div>
                        <div class="col-5 d-flex justify-content-end">Sales Tax 6.25%</div>
                        <div class="col-3 d-flex justify-content-end">20.00</div>
                    </div>
                </div>

            </div>

            {{-- <div class="row" style="margin-top:100px;">
                <h5>Thank You for your business</h5>
                <div class="row justify-content-end" style="margin-top:100px;">
                    <img src="./img/Layer 2.png" alt="" style="width: 173px; height: 111px;">
                </div>
            </div> --}}

    </div>
    </section>
</div>
</div>
