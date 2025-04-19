
@extends('layouts.frontend.app')
@section('title', 'Send by-mail')
@push('frontend_css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap"
        rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!--dashboard custom css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
@endpush
<style>
</style>

{{-- send by mail page css  --}}

@section('d-block')
    d-block
@endsection
@section('SendbyEmail')
    active
@endsection
@section('SendbyEmail_bg')
active_left
@endsection
@section('all_invoice')
    left_manu
@endsection
{{-- send by mail page css  --}}
@section('frontend_content')

    <section class="container-fluid bg-color ">
        <div class="row">
            <div class="col-md-3 col-lg-2 m-0 p-0">
                 <!-- user Dashboar sidebar  -->
               @include('frontend.dashboard.inc.sidebar')
                <!-- user Dashboar sidebar  -->
            </div>
            <div class="col-md-9 col-lg-10 m-0 p-0 mt-1">
                <div class="container-fluid overflow_scroll">
                    <div class="row">
                        <div class="card p-4 mt-2 table-responsive ">
                            <table id="example" class="table table-hover  mt-1"  style="color:#686868"  >
                                <thead>
                                    <tr>
                                        <th class="text-center">{{__('messages.SL')}}</th>
                                        <th>{{__('messages.MAIL_TO')}} </th>
                                        <th> {{__('messages.SUBJECT')}}</th>
                                        <th>{{__('messages.BODY')}}</th>
                                        <th class="text-center">{{__('messages.ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($sendByMails as $key => $sendByMail)
                                        <tr class="m-0 p-0  data_table_id">
                                            <td class="m-0  text-center ">{{ ++$key }}</td>
                                            <td class="m-0  ">{{ $sendByMail->send_mail_to }}</td>
                                            <td class="m-0  "> {{ $sendByMail->mail_subject }}</td>
                                            <td class="m-0  "> {!! Str::limit($sendByMail->mail_body, 60, ' ...') !!}</td>
                                            <td class="m-0 text-center ">
                                                 <a href="" class="preview_image_user btn btn-sm btn_view send_view_btn"    data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop_previw" ><i class="bi bi-eye "></i></a>


                                            </td>
                                             <input type="hidden" id="invoice_id_user" value="{{ $sendByMail->invoice_tamplate_id }}">

                                        </tr>
                                    @endforeach
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
