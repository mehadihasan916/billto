@extends('layouts.frontend.app')
@section('title', 'Unpaid-payment')
@push('frontend_css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap"
        rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!--dashboard custom css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
@endpush


@section('d-block')
    d-block
@endsection
@section('unpaid')
    active
@endsection
@section('unpaid_bg')
active_left
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

                    <div class="row">
                        <div class="card p-4 mt-2 table-responsive">
                            <table id="example" class="table table-hover  mt-1 " style="color: #686868">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{__('messages.SL')}}</th>
                                        <th>{{__('messages.CUSTOMER')}}</th>
                                        <th>{{__('messages.NUMBER')}}</th>
                                        <th>{{__('messages.DATE')}}</th>
                                        <th>{{__('messages.DUE_DATE')}}</th>
                                        <th>{{__('messages.TOTAL')}}</th>
                                        <th>{{__('messages.PAID')}}</th>
                                        <th>{{__('messages.DUE')}}</th>
                                        <th>{{__('messages.STATUS')}}</th>
                                        <th class="text-center">{{__('messages.ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($unpaid_Invoice_Counts as $key => $invoiceData)
                                    <tr class="m-0 p-0 data_table_id">
                                        <td class="m-0  text-center ">{{ ++$key }}</td>
                                        <td class="m-0  preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{!! Str::limit($invoiceData->invoice_to, 20, ' ...') !!}</td>
                                        <td class="m-0  preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"> {{ $invoiceData->invoice_id }}</td>
                                        <td class="m-0  preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{{ $invoiceData->invoice_date }}</td>
                                        <td class="m-0  preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{{ $invoiceData->invoice_dou_date }}</td>
                                        <td class="m-0   preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{{ $invoiceData->currency }} {{
                                            number_format($invoiceData->final_total,2) }}</td>
                                        <td class="m-0   preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{{ $invoiceData->currency }} {{
                                            number_format($invoiceData->receive_advance_amount,2) }}</td>
                                        <td class="m-0   preview_image_user " data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw" >{{ $invoiceData->currency }} {{
                                            number_format($invoiceData->balanceDue_amounts,2) }}</td>

                                        <td class="m-0">
                                            @if ($invoiceData->status_due_paid == 'due')
                                            <div class="due_btn">
                                                <a href="" class="preview_payment_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_paid_preview"> Due </a>
                                            </div>
                                            @elseif($invoiceData->status_due_paid == 'paid')
                                            <div class="paid_btn">
                                                <a href="#">Paid </a>
                                            </div>
                                            @endif
                                        </td>

                                        <td class=" m-0  text-center">
                                            @if ($invoiceData->invoice_status == 'complete')
                                            <a href="" title="Preview" class="preview_image_user btn btn-sm btn_view" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"><i class="bi bi-eye "></i></a>

                                            <button title="Send mail" style="background-color: #686868" type="button" id="send_email_id" class="btn btn-sm btn_edit send_invoice_mail" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="bi bi-envelope-fill"></i>
                                            </button>

                                            <a title="Download" style="background-color: #686868" href="/invoice/download/{{ $invoiceData->id }}" target="_blank" class="btn btn-sm btn_edit "> <i class="bi bi-arrow-down"></i> </a>
                                            @else

                                            @endif
                                        </td>
                                        <input type="hidden" id="invoice_id_user" value="{{ $invoiceData->id }}">

                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>

                            </table>
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
