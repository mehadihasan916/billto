@extends('layouts.frontend.app')
@section('title', 'User-dashboard')
@push('frontend_css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap"
        rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!--dashboard custom css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
@endpush
@section('frontend_content')

    <section class="container-fluid bg-color ">
        <div class="row">
            <div class="col-md-3 col-lg-2 m-0 p-0">
                 <!-- user Dashboar sidebar  -->
               @include('frontend.dashboard.inc.sidebar')
                <!-- user Dashboar sidebar  -->
            </div>
            <div class="col-md-9 col-lg-10 m-0 p-0 mt-1">
                <div class="container-fluid overflow_scroll  m-0 p-0 ">
                    <div class="row mt-2 m-0 p-0">
                        <div class="col-md-12 col-lg-4">
                            <div class="row">
                                @foreach ($join_table_value as $details_value) @endforeach
                                @foreach ($user as $userItem )    @endforeach
                                <div class="col-md-6 col-lg-12">
                                    <div class="card  card_mb dashboad_card_width">
                                        <div class="card-header"
                                            style="background-image: url('{{ asset('assets/frontend/img/user_dashbord/dashboard_img.png') }}');  background-repeat: no-repeat; background-size: cover;  height:96px;">
                                            <div class="heading_tag_desh">
                                                <h1 class="welcome_back"> {{__('messages.Welcome_to')}}</h1>
                                                <p>{{ $userItem->name }}</p>
                                            </div>
                                        </div>
                                        <style>
                                            .custopm_body_user{
                                                padding: 0px 12.5px 10px!important;
                                            }
                                            .pakage_details P{
                                                font-size: 12PX;
                                                color: #686868;
                                                font-weight: 400;
                                                margin-top: 10px;
                                            }
                                        </style>
                                        <div class="card-body custopm_body_user">
                                            <div class="row">

                                                @php
                                                $day =  $details_value->packageDuration;
                                                @endphp
                                                <div class="col-6">
                                                    <div class="address_user_phone">
                                                        <p class="p-0 m-0 fw-bold">{{__('messages.Package_details')}}</p>
                                                    </div>
                                                    <div class="row pakage_details pt-2">
                                                        <div class="col-12">
                                                           <p class="p-0 m-0"> {{__('messages.Package_name')}}: <span class="p-0 m-0 fw-bold"> {{ $details_value->packageName}} </span></p>
                                                        </div>

                                                        {{-- <div class="col-7">
                                                            <p class="p-0 m-0">Invoice template</p>
                                                         </div>
                                                         <div class="col-5">
                                                            <p class="p-0 m-0 fw-bold">{{ $details_value->templateQuantity}}</p>
                                                         </div> --}}
                                                         <div class="col-12">
                                                             <p class="p-0 m-0">{{__('messages.Total_invoice')}}: <span class="p-0 m-0 fw-bold">{{ $details_value->limitInvoiceGenerate}}</span>
                                                            </p>
                                                         </div>
                                                         <div class="col-12">
                                                         </div>
                                                         <div class="col-12">
                                                            <p class="p-0 m-0">{{__('messages.Total_genarate')}}:
                                                                <span class="p-0 m-0 fw-bold">{{ $details_value->current_invoice_total}}</span>
                                                            </p>
                                                         </div>

                                                         <div class="col-12">
                                                            <p class="p-0 m-0 "> {{__('messages.Duration')}}:
                                                                <span class="p-0 m-0 fw-bold">
                                                                    @php
                                                                        if ($day == 30) {
                                                                            echo 'One Month';
                                                                        } elseif ($day == 90) {
                                                                            echo 'Three Month';
                                                                        } elseif ($day == 180) {
                                                                            echo 'Six Month';
                                                                        } elseif ($day == 365) {
                                                                            echo 'Unlimited';
                                                                        }
                                                                    @endphp
                                                                </span>
                                                            </p>
                                                         </div>

                                                       <div class="col-12 pt-3">
                                                         <button class="btn  btn-sm btn-warning btn_bg text-white">{{__('messages.More_Package')}}</button>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="address_user_phone">
                                                        <p class="p-0 m-0">{{__('messages.Phone')}}</p>
                                                        <span class="p-0 m-0"> {{ $userItem->phone }}</span>
                                                        <p class="p-0 m-0">{{__('messages.Address')}}</p>
                                                        <span class="p-0 m-0"> {{ $userItem->address }}</span>
                                                    </div>
                                                    <div class="user_signeture">
                                                        <p class="p-0 m-0 mb-1">{{__('messages.Signature')}}</p>
                                                        <div class="d-flex align-items-center ">
                                                            <div class="Signature_img">
                                                                <img  src="{{ asset('uploads/signature/' . $userItem->signature) }}"  alt="Signature">
                                                            </div>
                                                            <div class="edit_signatuer_btn">
                                                                <a href="{{ url('/all/invoices/user-setting') }}" class="fs-4"> <i
                                                                        class="bi bi-pencil-square"></i></a>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6 col-lg-12">
                                    <div class="card dashboad_card_width">
                                        <div class="card-body">
                                            <div class="earning_header">
                                                <span>{{__('messages.Earning')}} </span>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                @php
                                                    // $paid_percentage = ($paid_Amount_conut*100)/$Total_Amount_conut;
                                                    // $total = round($paid_percentage);

                                                    // $due_percentage = ($due_Amount_conut*100)/$Total_Amount_conut;
                                                    // $due_total = round($due_percentage);

                                                    if($Total_Amount_conut!=null){
                                                    $paid_percentage = ($paid_Amount_conut*100);
                                                    $total = round($paid_percentage/$Total_Amount_conut);

                                                    $due_percentage = ($due_Amount_conut*100);
                                                    $due_total = round($due_percentage/$Total_Amount_conut);
                                                    }else{
                                                        $total=0;
                                                        $due_total=0;
                                                    }


                                                @endphp
                                                    <div class="monthly_total">
                                                        <p class="p-0 m-0">{{__('messages.Total_Amount_earnig')}}</p>
                                                        <span class="p-0 m-0 fw-bold">{{ number_format($Total_Amount_conut, 2) }}</span>

                                                    </div>
                                                    {{-- <div class="monthly_previus">
                                                        <a href="#">Previous month</a>
                                                    </div> --}}
                                                    <div
                                                        class="more_preview_btn d-flex justify-content-center align-items-center">
                                                        <a href="{{ url('/my-all-invoice') }}">{{__('messages.View_More')}}</a>
                                                    </div>
                                                </div>

                                                <div class="col-6">

                                                    <div class="d-flex justify-content-center">
                                                        <div class="earning_graph  d-flex   justify-content-center align-items-center">
                                                            <div>
                                                                <div role="progressbar" class="bar " aria-valuenow="{{ $total }}" aria-valuemin="0" aria-valuemax="100" style="--value:{{ $total }}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="d-flex align-items-center justify-content-center amount_div mt-1">
                                                            <div class="total_amount_bg"> </div>
                                                            <div class="ps-1"> <span>{{__('messages.Paid_earning')}}</span><span class="ps-1">({{ $total }}%)</span> </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center amount_div">
                                                            <div class="total_due_bg"> </div>
                                                            <div class="ps-1"> <span> {{__('messages.Due_earning')}} </span><span class="ps-1">({{ $due_total }}%)</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-8">
                            <div class="row">
                                <div class="col-6  col-md-4 col-lg-4">
                                    <div class="card  bg-c-pink">
                                        <div class="card-body ">
                                            <div class="d-flex">
                                                <div style="width:75%" class="total_amount_left">
                                                    <p class="">{{__('messages.Total_Amount_earnig')}}</p>
                                                    <span
                                                        class="">{{ number_format($Total_Amount_conut, 2) }}</span>
                                                </div>

                                                <div class="d-flex align-items-center  ">
                                                    <div  style="height: 40px; width:40px; border-radius:50%; background-color:
                                                    #0072BC" class=" d-flex justify-content-center align-items-center totalAmountIconBg ">
                                                        <div ><i
                                                            class="bi bi-arrows-fullscreen text-white totalAmountIcon"></i> </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6  col-md-4 col-lg-4">
                                    <div class="card  bg-c-pink">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div style="width:75%" class="total_amount_left_paid">
                                                    <p class=" ">{{__('messages.Paid_Amount')}}</p>
                                                    <span
                                                        class="">{{ number_format($paid_Amount_conut, 2) }}</span>
                                                </div>

                                                <div class="d-flex align-items-center ">
                                                    <div style="height: 40px; width:40px; border-radius:50%; background-color:
                                                    #197B30" class=" d-flex justify-content-center align-items-center totalAmountIconBg">
                                                        <div class=""><i class="bi bi-bag-check-fill text-white totalAmountIcon "></i> </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6  col-md-4 col-lg-4">
                                    <div class="card  bg-c-pink">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div style="width:75%" class="total_amount_left_due">
                                                    <p class=" "> {{__('messages.Due_Amount')}}</p>
                                                    <span
                                                        class="">{{ number_format($due_Amount_conut, 2) }}</span>
                                                </div>

                                                <div class="d-flex align-items-center    ">
                                                    <div style="height: 40px; width:40px; border-radius:50%; background-color:
                                                    #A950A0" class=" d-flex justify-content-center align-items-center totalAmountIconBg">
                                                        <div class=""><i class="bi bi-bag-dash-fill  text-white totalAmountIcon"></i> </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-6 col-md-4 col-lg-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Total Invoice</p>
                                                <h4 class="mb-0">{{ $all_Invoice_Count }}</h4>
                                            </div>
                                            <div
                                                class="d-flex justify-content-end align-item-center  cir-pink-bg text-white px-4 rounded-circle">
                                                <div class="m-auto"><i class="bi bi-receipt fs-6"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card table-responsive">
                                        <div class="card-body">
                                            <div class="card_title">
                                                <p>{{__('messages.Latest_Transaction')}} </p>
                                            </div>

                                            <table class="table table-hover table-responsive" style="color:#686868;   ">
                                                <thead
                                                    style="border-bottom: 2px solid #FFB317 !important;  border-top: 1px solid #FFB317 !important;">
                                                    <tr>
                                                        <th style="width:5%">{{__('messages.SL')}}#</th>
                                                        <th style="width:30%">{{__('messages.CUSTOMER')}} </th>
                                                        <th style="width:20%">{{__('messages.DATE')}}</th>
                                                        <th style="width:15%">{{__('messages.STATUS')}}</th>
                                                        <th style="width:15%">{{__('messages.PAID')}}</th>
                                                        <th style="width:15%">{{__('messages.TOTAL')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($latestDataInvoices as $key => $latestDataInvoice)
                                                    <tr class="data_table_id preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">
                                                        <th scope="row">{{ ++$key . ' - '. $latestDataInvoice->id }}</th>
                                                        <td>{!! Str::limit($latestDataInvoice->invoice_to, 20, ' ...') !!}</td>
                                                        <td>{{ $latestDataInvoice->invoice_date }}</td>
                                                        <td>
                                                            @if ($latestDataInvoice->status_due_paid=="due")
                                                            <div class="due_btn">
                                                                <a href="" class="preview_payment_user"data-bs-toggle="modal" data-bs-target="#staticBackdrop_paid_preview"> Due </a>

                                                            </div>
                                                            @elseif($latestDataInvoice->status_due_paid=="paid")
                                                            <div class="paid_btn">
                                                                <a href="">Paid </a>
                                                            </div>
                                                            @else
                                                            <div class="draft_btn">
                                                                <a href="">Draft </a>
                                                            </div>
                                                            @endif

                                                        </td>
                                                        <td>{{ number_format( $latestDataInvoice->receive_advance_amount,2) }}</td>
                                                        <td>{{number_format(  $latestDataInvoice->final_total,2 ) }}</td>

                                                        <input type="hidden" id="invoice_id_user" value="{{ $latestDataInvoice->id }}">
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Sign in form End -->
@endsection
@push('frontend_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                paging: true,
            });
        });
    </script>
@endpush
