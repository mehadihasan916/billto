@extends('layouts.frontend.app')
@section('title', 'All-invoice')
@push('frontend_css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap" rel="stylesheet">
<!--bootstrap css-->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
<!--dashboard custom css-->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
{{-- datatable css  --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

@endpush


{{-- home page css --}}

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

        <div class="col-md-9 col-lg-10 m-0 p-0 mt-1">
            <div class="container-fluid overflow_scroll">
                <div class="row mt-2">
                    <div class="card  table-responsive">
                        <div class="mt-1">
                            @if ($errors->any())
                            <div class=" alert alert-danger p-0 m-0">
                                <ul class="mt-2 text-danger">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <form action="{{ route('search.result') }}" method="post">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <div class="all_invice_title pt-2 d-flex ">
                                        <div>
                                            <p> {{__('messages.All_Invoice')}} </p>
                                        </div>
                                        <div>
                                            <span class="rond_all circle ms-2"> {{ $all_Invoice_Count }}</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center m-0 p-0">
                                    <div class="custom_width" style="width: 30%">
                                        <span>{{__('messages.Date_From')}}</span>
                                    </div>
                                    <div class="input-group bg-white custom_width_text" style="width: 70%">
                                        <label class="input-group-text" for="invoice_date"><i class="bi bi-calendar3"></i></label>
                                        <input type="text" class="form-control  bg-white @error('from_date')  is-invalid @enderror" name="from_date" required id="invoice_date" readonly>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center p-0">
                                    <div class="custom_width" style="width: 10%; text-align:center">
                                        <span>{{__('messages.To')}}</span>
                                    </div>
                                    <div class="input-group bg-white custom_width_text" style="width: 90%">
                                        <label class="input-group-text" for="invoice_dou_date"><i class="bi bi-calendar3"></i></label>
                                        <input type="text" class="form-control  bg-white @error('to_date')  is-invalid @enderror" name="to_date" required id="invoice_dou_date" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center align-items-center p-0">
                                    <div class="custom_width" style="width: 20%; text-align:center">
                                        <span>{{__('messages.Status')}}</span>
                                    </div>
                                    <div class="input-group bg-white custom_width_text" style="width: 80%">
                                        <select class="form-select  @error('invoice_status')  is-invalid @enderror" id="inputGroupSelect01" name="invoice_status" required>
                                            <option value="paid">Paid</option>
                                            <option value="due">Due</option>
                                            {{-- <option value="draft">Draft</option> --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-1 d-flex justify-content-end align-items-center">
                                    <div class="input-group   mr_custom">
                                        <button class=" btn btn-warning text-white">{{__('messages.Search_btn')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
<style>
    .text_color{
        color: #ff9000;
    }
</style>
                        <div style=" margin-top:25px"></div>
                        <table class="table table-hover btn_design" style="color:#686868" id="cart_realaod_table">
                            <thead style="border-bottom: 2px solid #FFB317 !important; border-top: 1px solid #FFB317 !important;">
                                <tr>
                                    <th style="width: 5%">{{__('messages.SL')}}#</th>
                                    <th style="width: 20%">{{__('messages.CUSTOMER')}} </th>
                                    <th style="width: 10%">{{__('messages.DATE')}}</th>
                                    <th style="width: 12%">{{__('messages.DUE_DATE')}}</th>
                                    <th style="width: 11%">{{__('messages.TOTAL')}}</th>
                                    <th style="width: 10%">{{__('messages.PAID')}}</th>
                                    <th style="width: 10%">{{__('messages.DUE')}}</th>
                                    <th style="width: 10%">{{__('messages.STATUS')}}</th>
                                    <th style="width:12%">{{__('messages.ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Illuminate\Support\Carbon;
                                @endphp
                                @foreach ($allInvoiceDatas as $key => $InvoiceData)
                                @php
                                    $curren_date =date('Y-m-d');
                                    $create_date = $InvoiceData->invoice_dou_date;
                                    $date = new Carbon($create_date);
                                    $today_date = $date->diffInDays($curren_date);
                               @endphp
                                <tr class="data_table_id table_th_td ">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td class="preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{!! Str::limit($InvoiceData->invoice_to, 20, ' ...') !!}</td>
                                    <td class="preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">{{ $InvoiceData->invoice_date }}</td>
                                    <td class=" preview_image_user
                                    <?php if($today_date <=3 && $curren_date <= $create_date && $InvoiceData->status_due_paid=="due" ){
                                        echo "text_color";
                                      }elseif( $curren_date >= $create_date  && $InvoiceData->status_due_paid=="due"){
                                        echo "text-danger";
                                     }  ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw">  {{ $InvoiceData->invoice_dou_date}} </td>
                                    <td class="preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"> {{ number_format($InvoiceData->final_total, 2) }} </td>
                                    <td class="preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"> {{ number_format($InvoiceData->receive_advance_amount, 2) }}</td>
                                    <td class="preview_image_user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"> {{ number_format($InvoiceData->balanceDue_amounts, 2) }}</td>

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

                                    <td>

                                        <a href="" title="Preview" class="preview_image_user btn btn-sm btn_view" data-bs-toggle="modal" data-bs-target="#staticBackdrop_previw"><i class="bi bi-eye "></i></a>
                                        <button title="Send mail" style="background-color: #686868" type="button" id="send_email_id" class="btn btn-sm btn_edit send_invoice_mail" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <i class="bi bi-envelope-fill"></i>
                                        </button>
                                        @auth
                                            @if(isset($subscriptionExpired) && $subscriptionExpired)
                                                <button title="Download" style="background-color: #686868" class="btn btn-sm btn_edit disabled" disabled>
                                                    <i class="bi bi-arrow-down"></i>
                                                </button>
                                            @else
                                                <a title="Download" style="background-color: #686868" href="/invoice/download/{{ $InvoiceData->id }}" target="_blank" class="btn btn-sm btn_edit">
                                                    <i class="bi bi-arrow-down"></i>
                                                </a>
                                            @endif
                                        @endauth

                                        {{-- @if ($InvoiceData->status_due_paid == 'paid')
                                        <button title="Send mail" style="background-color: #686868" type="button" id="send_email_id" class="btn btn-sm btn_edit send_invoice_mail" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <i class="bi bi-envelope-fill"></i>
                                        </button>
                                        <a title="Download" style="background-color: #686868" href="/invoice/download/{{ $InvoiceData->id }}" target="_blank" class="btn btn-sm btn_edit "> <i class="bi bi-arrow-down"></i> </a>
                                        @else --}}
                                        {{-- <a title="Edit" href="{{ route('edit.invoice', $InvoiceData->id) }}" class="btn btn-sm btn_edit"> <i class="bi bi-pencil"></i></a> --}}
                                        {{-- <a title="Delete" href="" class="btn btn-sm btn_delte"> <i
                                                class="bi bi-trash "></i></a> --}}
                                        {{-- @endif --}}


                                    </td>
                                    <input type="hidden" id="invoice_id_user" value="{{ $InvoiceData->id }}">

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{__('messages.TOTAL')}} : {{ number_format($Total_Amount_conut, 2) }}</th>
                                    <th>{{__('messages.PAID')}} : {{ number_format($paid_Total_Amount_conut, 2) }}</th>
                                    <th>{{__('messages.DUE')}} : {{ number_format($due_Total_Amount_conut, 2) }}</th>
                                    <th></th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row">
                            <div class="col-4 col-sm-6 col-md-7">
                                {{ $allInvoiceDatas->links() }}
                            </div>
                            {{-- <div class="col-8 col-sm-6 col-md-5">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="total_text_design">{{__('messages.TOTAL')}} </p>
                                    </div>
                                    <div class="col-5">
                                        <p class="total_amount text-end">{{ number_format($Total_Amount_conut, 2) }}</p>
                                    </div>

                                    <div class="col-4">
                                        <p class="total_text_design ">{{__('messages.PAID_AMOUNT')}} </p>
                                    </div>
                                    <div class="col-5">
                                        <p class="total_amount text-end">{{ number_format($paid_Total_Amount_conut, 2) }}</p>
                                    </div>

                                    <div class="col-4">
                                        <p class="total_text_design">{{__('messages.BALANCE_DUE')}} </p>
                                    </div>
                                    <div class="col-5 ">
                                        <p class="total_amount text-end">{{ number_format($due_Total_Amount_conut, 2) }}</p>
                                    </div>

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- <a class="btn btn-success" href="{{ route('invoice.show') }}">Show</a> --}}

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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- Dependencies for Excel/PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable({
            paging: true
        , });
    });

    // DataTable
    new DataTable('#cart_realaod_table', {
        layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'copy',
                        footer: true
                    },
                    {
                        extend: 'excel',
                        footer: true
                    },
                    {
                        extend: 'pdf',
                        footer: true
                    }
                ]
            }
        },
        // Required to activate buttons
        dom: 'Bfrtip',
        footer: true // This is not a DataTables option, but keep for clarity
    });


</script>
@endpush
