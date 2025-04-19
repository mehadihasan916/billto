<style>
    .page {
        width: 21cm;
        min-height: 29.7cm;
        overflow: hidden;
        margin: 0 auto;
        border: 0.1px solid #ece9e9;
    }

    /* .bgImg {
      background-image: url("/img/image_2022_12_10T04_44_18_427Z.png");
      background-repeat: no-repeat;
      background-size: 400px 1140px;
    } */
    .HeaderText {
        font-size: 20px;
        line-height: 28.8px;
        width: 700;

    }

    .HeaderTextP {
        font-size: 18px;
        font-weight: 400;
        line-height: 21px;
    }

    .to {
        font-size: 16px;
        width: 700;
        line-height: 19.2px;
    }

    .Neals {
        font-size: 14px;
        font-weight: 700;
        line-height: 16.8px;
    }

    .nealsP {
        font-size: 14px;
        font-weight: 400;
        line-height: 24px;
        color: #ffffff;
    }

    .invoiceColor {
        color: #039dbf;
        font-size: 42px;
        line-height: 72px;
    }

    .invoiceText {
        font-size: 16px;
        font-weight: 700;
        line-height: 26px;
        color: #686868;
    }

    .invoiceTextTwo {
        font-size: 16px;
        font-weight: 400;
        line-height: 25px;
        color: #686868;
    }

    .tablaHeaderColor {
        background-color: #CC3D3B;
        color: #ffffff;
    }

    .tableRowBgColor {
        background-color: #f2f2f2;
    }


    .tableTextColor {
        color: #686868;
    }

    .borderColor {
        border-color: #ffffff !important;
    }

    .bgColorSubTable {
        background-color: #039dbf !important;
        color: #ffffff;
    }

    .roted {
        font-size:35px;
        display: inline-block;
        overflow: visible;
        width: 1.2em;
        line-height: 4.4em;
        margin-top: 400%;
        margin-left: 40%;
        /* THIS is what fixed it! */
        white-space: nowrap;
        transform: rotate(270deg);
        -webkit-transform: rotate(270deg);
        color: #CC3D3B;

    }
</style>
<div class="page">
    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-2">
            <p class="roted" style="padding-top: 20%">Invoice: {{ $data->invoice_id }}</p>
        </div>
        <div class="col-10">
            <section>
                <div class="row ">
                    <div class="col-6 pb-3 ps-0" style="border-bottom:1px solid red">
                        <div class="">
                            <h1 style="font-size:21px;color:#CC3D3B" class="mb-1 mt-5">Women in Digital</h1>
                            <p style="font-size:11px">House 50-51(1st Floor) , Janata Co-operative Housing Society, Ring
                                Road, Mohammadpur, Dhaka,
                                Bangladesh 01635 497868 | info@womenindigital.net | womenindigital.net</p>
                        </div>
                        <div class="">
                            <h4 class="fw-bold mt-3 mb-1" style="color:#CC3D3B;font-size:13px">Billing Address:</h4>
                            <p style="font-size:13px">Women in Digital</p>
                            <p>{{ $data->invoice_form }}</p>
                            <p class="mt-2 " style="font-size:13px">
                                or <br> ACHIA KHALEDA NILA <br> Standard Chattered Bank <br> Account Number: 18 9317619
                                01 <br> SWIFT Code
                                SCBLBDDx Banani Branch, Dhaka <br> or <br> Zoom money transfer <br> <span
                                    style="color:#CC3D3B">wid.nila@gmail.com</span>
                            </p>

                        </div>
                        {{-- <div class="">
                            <h4 class="text-break"> {{ $data->invoice_form }}</h4>
                        </div>
                        <div class="mt-5">
                            <h4 class="to">{{ __('messages.To_send') }}</h4>
                            <p class="Neals text-break">{{ $data->invoice_to }}</p>
                        </div> --}}
                    </div>
                    <div class="col-5 p-0" style="border-bottom:1px solid red">
                        <div class="text-end mt-5 ">
                            @if ($userLogoAndTerms->invoice_logo != '')
                                <img style="object-fit:contain;"
                                    src="{{ asset('storage/invoice/logo/' . $userLogoAndTerms->invoice_logo) }}"
                                    alt="" height="20%" width="40%" />
                            @endif
                        </div>

                        <div class="d-flex justify-content-end " style="padding-top:67%">
                            <div>
                                <style>
                                    .table>:not(caption)>*>* {
                                        padding: 0.2rem 0.9rem;
                                        background-color: var(--bs-table-bg);
                                        /* border-bottom-width: 1px; */
                                        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
                                    }
                                </style>
                                <table class="table table-borderless ">
                                    {{-- <thead>
                                            <tr>
                                                <th scope="col-2" class="">{{ __('messages.Invoice_ID') }} #</th>
                                                <td scope="col-2" class="text-end pe-0">{{ $data->invoice_id }}</td>
                                            </tr>
                                        </thead> --}}
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="fw-bold " style="font-size:13px;color:#CC3D3B">
                                                {{ __('messages.Invoice_Date') }}</th>
                                            <td class="text-end pe-0" style="font-size:13px">{{ $data->invoice_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="fw-bold" style="font-size:13px;color:#CC3D3B">
                                                {{ __('messages.P_O_umber') }} #</th>
                                            <td class="text-end pe-0" style="font-size:13px">
                                                {{ $data->invoice_po_number }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="fw-bold" style="font-size:13px;color:#CC3D3B">
                                                {{ __('messages.Due_Date') }}</th>
                                            <td colspan="2" class="text-end pe-0" style="font-size:13px">
                                                {{ $data->invoice_dou_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="p-0 mt-1">
                        <h4 class="fw-bold mt-3 mb-1" style="color:#CC3D3B;font-size:13px">Bill To </h4>
                        {{-- <h4 class="to">{{ __('messages.To_send') }}</h4> --}}
                        <p class="Neals text-break">{{ $data->invoice_to }}</p>
                    </div>
                </div>
            </section>
            <!-- section two table section -->
            <section>
                <div class="row">
                    <div class="col-11" style=" padding:0px">
                        <div class="mt-3" style="margin-left:0px">
                            <table class="table table-bordered tableTextColor m-0 p-0 borderColor">
                                <thead>
                                    <tr class="tablaHeaderColor ">
                                        {{-- <th scope="col"> {{ __('messages.QTY') }}</th> --}}
                                        <th scope="col" style="font-size: 13px" class="text-center">
                                            {{ __('messages.DESCRIPTION') }}</th>
                                        {{-- <th scope="col" class="text-end">{{ __('messages.UNIT_PRICE') }}</th> --}}
                                        <th scope="col" style="font-size: 13px" class="text-end">
                                            {{ __('messages.AMOUNT') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="tableRowBgColor">
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($productsDatas as $product_detail)
                                        <tr>
                                            <th scope="row" style="font-size: 13px">
                                                {{ $product_detail->product_name }}</th>
                                            <td class="text-end" style="font-size: 13px">
                                                {{ number_format($product_detail->product_amount, 2) }}</td>
                                            {{-- <td>{{ number_format($product_detail->product_rate, 2) }}</td>
                                            <td class="text-end">
                                                {{ number_format($product_detail->product_amount, 2) }}</td> --}}
                                        </tr>
                                        @php
                                            $last_count = $count++;
                                        @endphp
                                    @endforeach
                                    @for ($x = $last_count; $x <= 5; $x++)
                                        <tr>
                                            <th style="font-size: 13px">&nbsp;</th>
                                            {{-- <td> </td> --}}
                                            {{-- <td class="text-end"></td> --}}
                                            <td class="text-end" style="font-size: 13px"></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <div class="row mt-0">
                                <div class="col-4"></div>
                                <div class="col-8 ">
                                    <table class="table table-borderless " style="margin:0; font-size:15px">
                                        <tbody>
                                            <tr>
                                                <td class="text-end">{{ __('messages.Sub_total') }}</td>
                                                <td class="text-end" style="">
                                                    {{ number_format($no_vat = $data->subtotal_no_vat, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-end"> {{ __('messages.Sales_Tax') }}
                                                    ({{ number_format($percent = $data->invoice_tax_percent) }} %)
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format(($no_vat * $percent) / 100, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-end"> {{ __('messages.Discount_Amount') }}
                                                    ({{ $data->discount_percent }}%)</td>
                                                <td class="text-end">
                                                    {{ number_format($data->discount_amounts, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end"> {{ __('messages.Receive_Advance_Amount') }}
                                                    ({{ $data->currency }})</td>
                                                <td class="text-end">
                                                    {{ number_format($data->receive_advance_amount, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end">
                                                    {{ __('messages.Requesting_Advance_Amount') }}
                                                    ({{ $data->requesting_advance_amount_percent }}%)</td>
                                                <td class="text-end">
                                                    {{ number_format(($data->final_total * $data->requesting_advance_amount_percent) / 100, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: 1px solid #CC3D3B; color:#000000"
                                                    class="text-end fw-bold">{{ __('messages.Total') }}</td>
                                                <td style="border-top: 1px solid #CC3D3B;color:#000000"
                                                    class="text-end fw-bold">
                                                    {{ $data->currency }}
                                                    {{ number_format($data->final_total - $data->receive_advance_amount, 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-7  ">
                        <div class="">
                            <h1
                                style="color: #000000; font-size: 18px; line-height: 36px; font-weight: 400;  margin-top:40px;">
                                {{ __('messages.Thank_You_for_your_business') }} </h1>
                        </div>
                        <div class="mt-4">
                            <h3 class="fw-bold p-2   mb-2"
                                style=" border-bottom: 1px solid #C4C4C4; font-size: 13px;  line-height: 17px; color: #CC3D3B;">
                                {{ __('messages.Terms_&_conditions') }}</h3>
                            <P class="mb-3 text-break"
                                style=" font-size: 14px; font-weight: 400; line-height: 14px; color: #000000;">
                                {{ $userLogoAndTerms->terms }}</P>
                            <P class="text-break"
                                style=" font-size: 14px; font-weight: 400; line-height: 14px; color: #000000;">
                                {{ $data->invoice_notes }}</P>
                        </div>
                    </div>

                    <div class="col-4  pt-5  d-flex justify-content-center align-items-center">
                        @if ($userLogoAndTerms->signature != '')
                            <div class="mx-auto ">
                                <img src="{{ asset('uploads/signature/' . $userLogoAndTerms->signature) }}"
                                    alt="" height="122px" width="122px" style="object-fit:contain;" />
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
