@extends('layouts.frontend.app')
@section('title', 'Billto.io')
@push('frontend_css')
@endpush
@section('frontend_content')

    <section class="container">
        <style>
            .package_title {
                font-size: 1.5rem;
                font-weight: 700;
            }

            .table {
                font-size: 16px;
                border: none;
            }

            .table th,
            td {
                border: none;
            }


            .pricing_card {
                border: none;
                box-shadow: 2px 9px 18px 2px #cfcfcf;
                position: fixed;
                top: 80px;
            }

            @media only screen and (max-width: 600px) {
                .pricing_card {
                    position: none;

                }
            }

            .pricing_card .card-header {
                background: rgb(255, 255, 255) !important;
            }
        </style>
        <style>
            .priceColor {
                color: #FFB317;
                font-size: 64px;
                font-weight: bold;
            }

            .heding {
                margin-top: 1.875rem;
                margin-bottom: 1.875rem;
                font-weight: bold;
            }

            .btnCss {
                background-color: #FFB317;
                color: #FFFFFF;
                border: none;
                border-radius: 5px;
                font-size: 18px;
                font-weight: 700;
                line-height: 40px;
                text-align: center;
                padding: 8px 57px;
            }
        </style>

        <div class="row my-2  ">
            <div class="col-sm-7">
                <div class="row">
                    @foreach ($package_tamplate as $package_tamp)
                        <div class="col-sm-6 mb-4">
                            <div class="tamplate_show_home">
                                <img src="{{ asset('uploads/template/' . $package_tamp->templateImage) }}" class="w-100"
                                    alt="" style="border: 1px solid #ccc;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-5">
                @if (Config::get('languages')[App::getLocale()]['flag-icon'] == 'bd')
                    @foreach ($subscribe_package as $sub_package_free)
                        @php
                            $day = $sub_package_free->packageDuration;
                        @endphp

                        <div class="card text-center ">
                            <div class="card-body shadowcard p-0">
                                <h3 class="heding"> {{ $sub_package_free->packageNamebn }}</h3>
                                <h1 class="priceColor"> &#2547;{{ $sub_package_free->pricebn }}<span
                                        class="month">/মাস</span>
                                </h1>
                                {{-- <p class="text_muted">
            galley of type and scrambled it to make a type specimen book.
        </p> --}}
                                <div class="emty_margin"></div>
                                <div class="text-start text_start ">
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        মোট চালান : <strong> {{ $sub_package_free->templateQuantitybn }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" /> চালান তৈরি করতে পারবেন : <strong>
                                            {{ $sub_package_free->limitInvoiceGeneratebn }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        প্যাকেজের সময়কাল : <strong> @php
                                            if ($day == 30) {
                                                echo 'এক মাস';
                                            } elseif ($day == 90) {
                                                echo 'তিন মাস';
                                            } elseif ($day == 180) {
                                                echo 'ছয় মাস';
                                            } elseif ($day == 365) {
                                                echo 'এক বছর';
                                            }
                                        @endphp
                                        </strong>
                                    </div>

                                    @php
                                        $join_pricing_subcription_tbl = DB::table('subscription_packages')
                                            ->join('pricings', 'subscription_packages.id', '=', 'pricings.subscription_package_id')
                                            ->where('pricings.subscription_package_id', $sub_package_free->id)
                                            ->get();
                                    @endphp
                                    @foreach ($join_pricing_subcription_tbl as $join_pricing_subcription_value)
                                        <div class="text-muted margingPlanP">
                                            @if ($join_pricing_subcription_value->logo == 'Success')
                                                <img class="none_image"
                                                    src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                    alt="" />{{ $join_pricing_subcription_value->descriptionbn }}
                                            @else
                                                <img class="none_image"
                                                    src="{{ asset('assets/frontend/img/icon/none.png') }}"
                                                    alt="" />{{ $join_pricing_subcription_value->descriptionbn }}
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                                <div class="pricing_btn_design">
                                    <a href="{{ url('payment-gateway', $sub_package_free->id) }}"><button
                                            class="btnCss">সাবমিট</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($subscribe_package as $sub_package_free)
                        @php
                            $day = $sub_package_free->packageDuration;
                        @endphp

                        <div class="card text-center ">
                            <div class="card-body shadowcard p-0">
                                <h3 class="heding"> {{ $sub_package_free->packageName }}</h3>
                                <h1 class="priceColor">${{ $sub_package_free->price }}<span class="month">/month</span>
                                </h1>
                                
                                <div class="emty_margin"></div>
                                <div class="text-start text_start ">
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Invoice
                                        Template: <strong> {{ $sub_package_free->price }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" /> Total
                                        invoice Genarate: <strong> {{ $sub_package_free->limitInvoiceGenerate }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Package Duration: <strong> @php
                                            if ($day == 30) {
                                                echo 'One Month';
                                            } elseif ($day == 90) {
                                                echo 'Three Month';
                                            } elseif ($day == 180) {
                                                echo 'Six Month';
                                            } elseif ($day == 365) {
                                                echo 'One Year';
                                            }
                                        @endphp
                                        </strong>
                                    </div>

                                    @php
                                        $join_pricing_subcription_tbl = DB::table('subscription_packages')
                                            ->join('pricings', 'subscription_packages.id', '=', 'pricings.subscription_package_id')
                                            ->where('pricings.subscription_package_id', $sub_package_free->id)
                                            ->get();
                                    @endphp
                                    @foreach ($join_pricing_subcription_tbl as $join_pricing_subcription_value)
                                        <div class="text-muted margingPlanP">
                                            @if ($join_pricing_subcription_value->logo == 'Success')
                                                <img class="none_image"
                                                    src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                    alt="" />{{ $join_pricing_subcription_value->description }}
                                            @else
                                                <img class="none_image"
                                                    src="{{ asset('assets/frontend/img/icon/none.png') }}"
                                                    alt="" />{{ $join_pricing_subcription_value->description }}
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                                <div class="pricing_btn_design">
                                    <a href="{{ url('payment-gateway', $sub_package_free->id) }}"><button
                                            class="btnCss">Submit</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif



            </div>
        </div>
        {{-- ----------------- javascript kora ache--------  --}}
        {{-- <div class="row my-2">
        <div class="col-sm-7 ">
            @foreach ($subscribe_package as $subscribe)
            @php
            $day = $subscribe->packageDuration;
           @endphp
            <div class="card">
                <div class="card-body text-center bg-success">
                    <h5 class="card-title"></h5>
                 </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> Invoice Template: <strong>{{ $subscribe->templateQuantity }}</strong> </li>
                    <li class="list-group-item">Total invoice Genarate: <strong>{{ $subscribe->templateQuantity }}</strong></li>
                    <li class="list-group-item">Package Duration: <strong>  @php
                        if($day==30){ echo "One Month"; }elseif($day==90){ echo "Three Month";}elseif($day==180){  echo "Six Month"; }elseif($day==365){ echo "One Year";}
                        @endphp</strong></li>
                    <li class="list-group-item">Package Price: <strong>Tk. {{ $subscribe->price }}</strong></li>
                    <input type="hidden" id="package_price" value="{{ $subscribe->price }}">
                </ul>
            </div>

            @endforeach
        </div>
        <div class="col-sm-5">
            <div class="card">
                <form action="" id="getway_setup" method="post">
                    @csrf
                <div class="card-body">
                    <label for="">Payment Amount</label>
                    <input type="hidden" id="package_id" name="package_id"value="{{ $subscribe->id }}">
                    <input type="hidden" id="auth_user_id" name="auth_user_id" value="{{ auth()->user()->id }}">
                    <input type="number"  style="width:300px;" name="new_package_price" id="new_package_price" class="form-control" >
                     <small id="message" class="text-danger"></small>
                    <div class="mt-2">
                        <button class="btn btn-success" id="submit_button" disabled >Submit</button>
                    </div>
                </div>
            </form>
            </div>


        </div>
    </div> --}}


    </section>

    <script>
        // $( "#new_package_price" ).bind( "keyup", function() {
        //     var package_price = document.getElementById('package_price').value;
        //     var new_package_price = document.getElementById('new_package_price').value;

        //   if(package_price== new_package_price){

        //     $('#new_package_price').addClass("is-valid");
        //     $('#new_package_price').removeClass("is-invalid");
        //     document.getElementById("submit_button").disabled = false;
        //     document.getElementById("message").innerHTML = "";
        //   }else{
        //     $('#new_package_price').addClass("is-invalid");
        //     document.getElementById("submit_button").disabled = true;
        //     document.getElementById("message").innerHTML = "Please set Correct value";
        //   }
        // });
    </script>




@endsection
@push('frontend_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
