@extends('layouts.frontend.app')
@section('title', 'Draft-invoice')
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
@section('Trush')
    active
@endsection
@section('Trush_bg')
Trush_bg
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
                                        <th>{{__('messages.PAID')}}</th>
                                        <th>{{__('messages.TOTAL')}}</th>
                                        <th class="text-center">{{__('messages.ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoicessData as $key => $invoiceData)
                                        <tr class="m-0 p-0 ">
                                            <td class="m-0  text-center ">{{ ++$key }}</td>
                                            <td class="m-0  "> {!! Str::limit($invoiceData->invoice_to, 20, ' ...') !!}</td>
                                            <td class="m-0   ">
                                                {{ $invoiceData->invoice_id }}
                                            </td>
                                            <td class="m-0  ">{{ $invoiceData->invoice_date }}</td>
                                            <td class="m-0  ">{{ $invoiceData->currency }} {{ number_format($invoiceData->receive_advance_amount,2) }}</td>
                                            <td class="m-0  ">{{ $invoiceData->currency }}  {{ number_format($invoiceData->final_total,2) }}</td>

                                            <td class=" m-0  text-center">
                                                @if ($invoiceData->invoice_status == 'complete')
                                                    <a class="custom_btn_sm" href=""><i
                                                            class="bi bi-eye iconTable"></i></a>
                                                @else
                                                <a href="{{ route('edit.invoice', $invoiceData->id) }}"
                                                    class="btn btn-sm btn_edit"> <i class="bi bi-pencil"></i></a>
                                                    {{-- <a href="" class="btn btn-sm btn_delte"> <i class="bi bi-trash "></i></a> --}}
                                                @endif
                                            </td>
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
