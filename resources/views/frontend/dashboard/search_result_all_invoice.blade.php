@extends('layouts.frontend.app')
@section('title', 'Search-result')
@push('frontend_css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap" rel="stylesheet">
<!--bootstrap css-->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
<!--dashboard custom css-->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
@endpush

{{-- home page css  --}}

@section('d-block')
d-block
@endsection
@section('all-invoice')
active
@endsection
@section('all_invoice_left')
active_left
@endsection
@section('all_invoice')
left_manu
@endsection
@section('frontend_content')

<section class="container-fluid bg-color ">
    <div class="row">
        <div class="col-md-3 col-lg-2 m-0 p-0">
            <!-- user Dashboar sidebar  -->
            @include('frontend.dashboard.inc.sidebar')
            <!-- user Dashboar sidebar  -->
        </div>

        <style>
            .dashboad_card_width {
                width: 100%;
                height: 255px;
            }

        </style>
        <div class="col-md-9 col-lg-10 m-0 p-0 mt-1">
            <div class="container-fluid overflow_scroll">
                <div class="row mt-2">
                    <div class="card  table-responsive">

                <div class="row pt-2 ">
                    <div class="col-10">
                        <h6 class="pt-2 text-center">Search Results <span class="text-success">From:
                                {{ $date_from }} -- To: {{ $date_to }} </span> Payment <span class="text-success">Status: {{ $invoice_status }}</span></h6>
                    </div>

                    <div class="col-2 text-end pt-2">
                        <a href="{{ url('my-all-invoice') }}" style="background:#686868; " class="btn btn-sm  fw-bold text-white"> <i class="bi bi-arrow-left-short fw-bold text-white"></i> Back &nbsp; </a>
                    </div>
                </div>

                <div style=" margin-top:2px"></div>
                <table class="table table-hover btn_design" style="color:#686868">
                    <thead style="border-bottom: 2px solid #FFB317 !important; border-top: 1px solid #FFB317 !important;">
                        <tr>
                            <th style="width: 8%">{{__('messages.SL')}}#</th>
                            <th style="width: 20%">{{__('messages.CUSTOMER')}} </th>
                            <th style="width: 15%">{{__('messages.DATE')}}</th>
                            <th style="width: 15%">{{__('messages.STATUS')}}</th>
                            <th style="width: 15%">{{__('messages.PAID')}}</th>
                            <th style="width: 15%">{{__('messages.TOTAL')}}</th>
                            <th style="width:12%">{{__('messages.ACTION')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $final_total = 0;
                        $paid_total = 0;
                        $due_total = 0;
                        @endphp
                        @forelse($search_result as $key => $InvoiceData)
                        <tr class="data_table_id preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw" >
                            <th scope="row">{{ ++$key }}</th>
                            <td>{!! Str::limit($invoiceData->invoice_to, 20, ' ...') !!}</td>
                            <td>{{ $InvoiceData->invoice_date }}</td>
                            <td>
                                @if ($InvoiceData->status_due_paid == 'due')
                                <div class="due_btn">
                                    <a href="" class="preview_payment_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_paid_preview"> Due </a>
                                </div>
                                @elseif($InvoiceData->status_due_paid == 'paid')
                                <div class="paid_btn">
                                    <a href="#">Paid </a>
                                </div>
                                @endif
                            </td>
                            <td> {{ number_format($InvoiceData->receive_advance_amount, 2) }}</td>

                            <td> {{ number_format($InvoiceData->final_total, 2) }} </td>
                            <td>
                                <a href="" class="preview_image_user btn btn-sm btn_view" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"><i class="bi bi-eye "></i></a>
                            </td>
                            <input type="hidden" id="invoice_id_user" value="{{ $InvoiceData->id }}">

                        </tr>
                        @php
                        $final_total += $InvoiceData->final_total;
                        $paid_total += $InvoiceData->receive_advance_amount;
                        $due_total += $InvoiceData->balanceDue_amounts;
                        @endphp
                        @empty
                        <tr>
                            <td colspan="7" class=" text-center text-danger">Search result not found !
                            </td>
                        </tr>
                        <style>
                            .display_none {
                                display: none;
                            }

                        </style>
                        @endforelse
                    </tbody>
                </table>
                <div class="row display_none">
                    <div class="col-4 col-sm-6 col-md-7">

                    </div>
                    <div class="col-8 col-sm-6 col-md-5">
                        <div class="row">
                            <div class="col-4">
                                <p class="total_text_design">{{__('messages.TOTAL')}} </p>
                            </div>
                            <div class="col-5">
                                <p class="total_amount text-end">{{ number_format($final_total, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p class="total_text_design ">{{__('messages.PAID_AMOUNT')}} </p>
                            </div>
                            <div class="col-5">
                                <p class="total_amount text-end">{{ number_format($paid_total, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p class="total_text_design"> {{__('messages.BALANCE_DUE')}}</p>
                            </div>
                            <div class="col-5">
                                <p class="total_amount text-end">{{ number_format($due_total, 2) }}</p>
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
            paging: true
        , });
    });

</script>
@endpush
