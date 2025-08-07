@extends('layouts.frontend.app')
@section('title', 'Billto.io')
@push('frontend_css')
@endpush
@section('frontend_content')
    <!-- Banner Start -->
    <section class="banner_section">
        <div
            style="background: url({{ asset('assets/frontend/img/banner/banner-back.jpg') }}); opacity: .8; padding-bottom: 28px;">
            <div class="container pt-5">
                <div class="row align-items-center">
                    <div class="col-sm-6 text ">
                        <a href="{{ route('create') }}" class="btn billto_btn "><span>{{__('messages.home_create_bill_btn')}}</span></a>
                    </div>
                    <div class="col-sm-6 text-end image_width">
                        <img src="{{ asset('assets/frontend/img/banner/banner.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->


    <!-- Create Start -->
    <section class="create_section">
        <div class="container">
            <div class="row ctrate-text">
                <div class="col-sm-4 mb_sm_3">
                    <div class="icon_style imgHeightwidth">
                        <img src="{{ asset('assets/frontend/img/icon/file.png') }}" alt=""
                            style="width: 39px; height: 42px; top:3px; left:4.5px;">
                    </div>
                    <h2 class="h2_title heading">{{__('messages.CreateBill')}}</h2>
                    <p class="create_section_p">{{__('messages.Choose_from_20_templates')}}</p>
                </div>
                <div class="col-sm-4 mb_sm_3">
                    <div class="icon_style imgHeightwidth">
                        <img src="{{ asset('assets/frontend/img/icon/pdf.png') }}" alt=""
                            style="width: 39px; height: 42px; top:3px; left:4.5px;">
                    </div>
                    <h2 class=" h2_title">{{__('messages.SendPDF')}}</h2>
                    <p class="create_section_p">{{__('messages.Email_or_print_your_invoice')}} <br> {{__('messages.to_send_to_your_client')}}</p>
                </div>
                <div class="col-sm-4 ">
                    <div class="icon_style imgHeightwidth">
                        <img src="{{ asset('assets/frontend/img/icon/card.png') }}" alt=""
                            style="width: 38px; height: 34px; top:3px; left:4.5px;">
                    </div>
                    <h2 class="h2_title">{{__('messages.GetPaid')}}</h2>
                    <p class="create_section_p">{{__('messages.Receive_payment_in')}}<br>{{__('messages.accounts_by_Card_or_Paypal')}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Create End -->
    <!-- Invoice Template Start -->
    <section class="invoice_template ">
        <div class="container ">
            <div class="text-center ctrate-text">
                <p class="h2_title2">{{__('messages.Choose_Your_Invoice_Template')}}</p>
                <p class="invoice_p">{{__('messages.Start_creating_your_professional_bill')}}</p>
            </div>
             <div class="row invoice_template_margin justify-content-center" id="invoice_template_margin1">

            </div>
        </div>
    </section>
    <!-- Invoice Template End -->
    @php
        $count1 = 1;
        $count2 = 1;
    @endphp
    <div class="package_area ">
        <div class="container package_area_border">
            <div class="row" style="margin-bottom: 58px;">
                <div class="col-12">
                    <div class="plan text-center ctrate-text">
                        <span>{{__('messages.There’s_a_BillTO_for_every_business')}}</span>
                        <p>{{__('messages.There’s_a_BillTO_description')}}</p>
                    </div>
                </div>
            </div>
            @if (Config::get('languages')[App::getLocale()]['flag-icon'] == 'bd')
                {{-- Bangla language  start  --}}
                <div class="row">
                    @if($subcription_package_free->count() > 0)
                        @foreach ($subcription_package_free as $sub_package_free)
                            @php
                                $day = $sub_package_free->packageDuration;
                            @endphp

                            <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                                <div class="card text-center ">
                                    <div class="card-body shadowcard p-0">
                                        <h3 class="heding"> {{ $sub_package_free->packageNamebn }}</h3>
                                        <h1 class="priceColor"> &#2547;{{ $sub_package_free->pricebn }}<span class="month">/মাস</span>
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
                                                    alt="" /> চালান তৈরি করতে পারবেন : <strong> {{ $sub_package_free->limitInvoiceGeneratebn }}</strong>
                                            </div>
                                            <div class="text-muted margingPlanP">
                                                <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                    alt="" />
                                                        প্যাকেজের সময়কাল : <strong> @php
                                                    if ($day == 30) {
                                                        echo 'এক মাস';
                                                    } elseif ($day == 90) {
                                                        echo 'তিন মাস';
                                                    } elseif ($day == 180) {
                                                        echo 'ছয় মাস';
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
                                                    class="btnCss">বিনামূল্যে</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Show default Free Plan if no packages found --}}
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                            <div class="card text-center ">
                                <div class="card-body shadowcard p-0">
                                    <h3 class="heding">ফ্রি প্ল্যান</h3>
                                    <h1 class="priceColor"> £0<span class="month">/মাস</span></h1>
                                    <div class="emty_margin"></div>
                                    <div class="text-start text_start ">
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                            মোট চালান : <strong>৩</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                            চালান তৈরি করতে পারবেন : <strong>৫</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                            প্যাকেজের সময়কাল : <strong>এক মাস</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                            মাসে সর্বোচ্চ ৫টি চালান তৈরি করুন
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                            ক্রেডিট কার্ডের প্রয়োজন নেই
                                        </div>
                                    </div>
                                    <div class="pricing_btn_design">
                                        <a href="{{ url('packages') }}"><button class="btnCss">বিনামূল্যে</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- standard pakage  --}}
                    @foreach ($subcription_package_stand as $sub_package_stnd)
                        @php
                            $day = $sub_package_stnd->packageDuration;
                        @endphp

                        <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                            <div class="card text-center">
                                <div class="card-body shadowcard p-0">
                                    <h3 class="heding"> {{ $sub_package_stnd->packageNamebn }}</h3>
                                    <h1 class="priceColor">&#2547;{{ $sub_package_stnd->pricebn }}<span class="month">/মাস</span>
                                    </h1>
                                    {{-- <p class="text_muted">
                                    galley of type and scrambled it to make a type specimen book.
                                </p> --}}
                                    <div class="emty_margin"></div>
                                    <div class="text-start text_start ">
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                alt="" />
                                                মোট চালান : <strong> {{ $sub_package_stnd->templateQuantitybn }}</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                alt="" /> চালান তৈরি করতে পারবেন :  <strong> {{ $sub_package_stnd->limitInvoiceGeneratebn }}</strong>
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
                                                ->where('pricings.subscription_package_id', $sub_package_stnd->id)
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
                                        <a href="{{ url('payment-gateway', $sub_package_stnd->id) }}"><button
                                                class="btnCss">শীঘ্রই আসছে</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- standard pakage END  --}}

                    {{-- Primium pakage  --}}
                    @foreach ($subcription_package_premium as $sub_package_primium)
                        @php
                            $day = $sub_package_primium->packageDuration;
                        @endphp

                        <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                            <div class="card text-center">
                                <div class="card-body shadowcard p-0">
                                    <h3 class="heding"> {{ $sub_package_primium->packageNamebn }}</h3>
                                    <h1 class="priceColor">&#2547;{{ $sub_package_primium->pricebn }}<span
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
                                                মোট চালান : <strong> {{ $sub_package_primium->templateQuantitybn }}</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                alt="" /> চালান তৈরি করতে পারবেন :  <strong> সীমাহীন</strong>
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
                                                ->where('pricings.subscription_package_id', $sub_package_primium->id)
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
                                        <a href="{{ url('payment-gateway', $sub_package_primium->id) }}"><button
                                                class="btnCss">শীঘ্রই আসছে</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Primium pakage END  --}}

                </div>

        @else
        {{-- English language  start  --}}
            <div class="row">
                @if($subcription_package_free->count() > 0)
                    @foreach ($subcription_package_free as $sub_package_free)
                        @php
                            $day = $sub_package_free->packageDuration;
                        @endphp

                        <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                            <div class="card text-center ">
                                <div class="card-body shadowcard p-0">
                                    <h3 class="heding"> {{ $sub_package_free->packageName }}</h3>
                                    <h1 class="priceColor">£{{ $sub_package_free->price }}<span class="month">/month</span>
                                    </h1>
                                    {{-- <p class="text_muted">
                                        galley of type and scrambled it to make a type specimen book.
                                    </p> --}}
                                    <div class="emty_margin"></div>
                                    <div class="text-start text_start ">
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                alt="" />
                                            Invoice Template: <strong>{{ $sub_package_free->templateQuantity }}</strong>
                                        </div>
                                        <div class="text-muted margingPlanP">
                                            <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                                alt="" /> Total
                                            invoice Generate: <strong> {{ $sub_package_free->limitInvoiceGenerate }}</strong>
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
                                                class="btnCss">Free</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Show default Free Plan if no packages found --}}
                    <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                        <div class="card text-center ">
                            <div class="card-body shadowcard p-0">
                                <h3 class="heding">Free Plan</h3>
                                <h1 class="priceColor">£0<span class="month">/month</span></h1>
                                <div class="emty_margin"></div>
                                <div class="text-start text_start ">
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                        Invoice Template: <strong>3</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                        Total invoice Generate: <strong>5</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                        Package Duration: <strong>One Month</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                        Create up to 5 invoices per month
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}" alt="" />
                                        No credit card required
                                    </div>
                                </div>
                                <div class="pricing_btn_design">
                                    <a href="{{ url('packages') }}"><button class="btnCss">Free</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- standard pakage  --}}
                @foreach ($subcription_package_stand as $sub_package_stnd)
                    @php
                        $day = $sub_package_stnd->packageDuration;
                    @endphp

                    <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                        <div class="card text-center">
                            <div class="card-body shadowcard p-0">
                                <h3 class="heding"> {{ $sub_package_stnd->packageName }}</h3>
                                <h1 class="priceColor">${{ $sub_package_stnd->price }}<span class="month">/month</span>
                                </h1>
                                {{-- <p class="text_muted">
                                galley of type and scrambled it to make a type specimen book.
                            </p> --}}
                                <div class="emty_margin"></div>
                                <div class="text-start text_start ">
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Invoice
                                        Template: <strong> {{ $sub_package_stnd->price }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" /> Total
                                        invoice Genarate: <strong> {{ $sub_package_stnd->limitInvoiceGenerate }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Package
                                        Duration: <strong> @php
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
                                            ->where('pricings.subscription_package_id', $sub_package_stnd->id)
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
                                    <a href="{{ url('payment-gateway', $sub_package_stnd->id) }}"><button
                                            class="btnCss">Buy Now</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- standard pakage END  --}}

                {{-- Primium pakage  --}}
                @foreach ($subcription_package_premium as $sub_package_primium)
                    @php
                        $day = $sub_package_primium->packageDuration;
                    @endphp

                    <div class="col-md-6 col-sm-12 col-lg-4 mb-4 borderNoneCard">
                        <div class="card text-center">
                            <div class="card-body shadowcard p-0">
                                <h3 class="heding"> {{ $sub_package_primium->packageName }}</h3>
                                <h1 class="priceColor">${{ $sub_package_primium->price }}<span
                                        class="month">/month</span>
                                </h1>
                                {{-- <p class="text_muted">
                                             galley of type and scrambled it to make a type specimen book.
                                         </p> --}}
                                <div class="emty_margin"></div>
                                <div class="text-start text_start ">
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Invoice
                                        Template: <strong> {{ $sub_package_primium->price }}</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" /> Total
                                        invoice Genarate: <strong> Unlimited</strong>
                                    </div>
                                    <div class="text-muted margingPlanP">
                                        <img class="none_image" src="{{ asset('assets/frontend/img/icon/tik.png') }}"
                                            alt="" />
                                        Package
                                        Duration: <strong> @php
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
                                            ->where('pricings.subscription_package_id', $sub_package_primium->id)
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
                                    <a href="{{ url('payment-gateway', $sub_package_primium->id) }}"><button
                                            class="btnCss">Coming Soon</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Primium pakage END  --}}

            </div>
            @endif

        </div>
    </div>


    <!--  Package subscription  End -->
@endsection
@push('frontend_js')
@endpush
