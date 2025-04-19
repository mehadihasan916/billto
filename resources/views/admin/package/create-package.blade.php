@extends('layouts.admin.admin')
@section('title', 'Home Page')

@push('admin_style_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
@section('page_content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Create-package </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!--************************************
                                    ********** Main content Start ***********
                                    ************************************-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="card p-2 mt-1">
                                    <h3>Create subscription package
                                        <a href="{{ url('admin/package/list') }}"
                                            class="btn btn-primary btn-sm text-white  float-end p-2"> <i
                                                class="bx bx-right-arrow-alt "></i> Subscription package List
                                        </a>
                                    </h3>
                                </div>
                                <hr>
                                <form action="{{ url('admin/package/store') }}" method="POST" class="needs-validation"
                                    novalidate enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Package name(EN)</label>
                                                <input type="text" name="packageName" class="form-control"
                                                    id="validationCustom01" required>

                                                <label for="validationCustom01" class="form-label mt-2">Package name(BN)</label>
                                                <input type="text" name="packageNamebn" class="form-control"
                                                    id="validationCustom01" required>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label"> Package Duration</label>
                                                <select class="form-select" name="packageDuration" id="validationCustom02"
                                                    required>
                                                    <option selected disabled value="">Select package</option>
                                                    <option value="30">One Month</option>
                                                    <option value="90">three Month</option>
                                                    <option value="180">Six Month</option>
                                                    <option value="365">One Year</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Package Price(EN)</label>
                                                <input type="number" name="price" class="form-control"
                                                    id="validationCustom02" required>

                                                    <label for="validationCustom03" class="form-label mt-2">Package Price(BN)</label>
                                                    <input type="text" name="pricebn" class="form-control"
                                                        id="validationCustom02" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Tamplate Quantity(EN)</label>
                                                <input type="number" name="templateQuantity" class="form-control"
                                                    id="validationCustom02" required>
                                                <label for="validationCustom03" class="form-label mt-2">Tamplate Quantity(BN)</label>
                                                <input type="text" name="templateQuantitybn" class="form-control"
                                                    id="validationCustom02" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Limit invoice
                                                    generate</label>
                                                <input type="number" name="limitInvoiceGenerate" class="form-control"
                                                    id="validationCustom02" required>

                                                    <label for="validationCustom03" class="form-label mt-2">Limit invoice
                                                        generate(BN)</label>
                                                    <input type="text" name="limitInvoiceGeneratebn" class="form-control"
                                                        id="validationCustom02" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- choose template --}}
                                    <div class="row mt-3">
                                        <h3 class="mb-3">Choose tamplate</h3>
                                        <div class="row">
                                            @foreach ($invoiceTemplates as $invoiceTemplate)
                                                <div class="col-md-4 mb-2">
                                                    <div class=" d-flex">
                                                        <input type="checkbox" name="template[]"
                                                            value="{{ $invoiceTemplate->id }}"
                                                            style="height: 20px; width:20px">
                                                        <label
                                                            class="form-label ms-2">{{ $invoiceTemplate->templateName }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- pricing description --}}
                                    <h3 class="mt-3">Pricing Description</h3>
                                    <div class="main-form">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label for="">Select Icon/Logo</label>
                                                    <select class="form-control" name="logo[]" id="" required>
                                                        <option selected disabled value="">Select Icon</option>
                                                        <option value="Success">Success</option>
                                                        <option value="Cross">Cross</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group mb-2">
                                                    <label for="">Pricing Description(EN)</label>
                                                    <textarea name="description[]" class="form-control" required rows="1"></textarea>
                                                    <label for="" class="mt-2">Pricing Description(BN)</label>
                                                    <textarea name="descriptionbn[]" class="form-control" required rows="1"></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="paste-new-forms"></div>

                                    <div class="float-end me-4 mt-2">
                                        <a href="javascript:void(0)" class="add-more-form  btn btn-success"><i
                                                class="bx bx-plus-medical"></i></a>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->

                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

                <script>
                    $(document).ready(function() {

                        $(document).on('click', '.remove-btn', function() {
                            $(this).closest('.main-form').remove();
                        });

                        $(document).on('click', '.add-more-form', function() {
                            $('.paste-new-forms').append('<div class="main-form ">\
                                                            <div class="row">\
                                                                <div class="col-sm-4">\
                                                                    <div class="form-group ">\
                                                                        <label for="">Select Icon/Logo</label>\
                                                                        <select class="form-control" name="logo[]" id="" required>\
                                                                            <option selected disabled value="">Select Icon</option>\
                                                                            <option value="Success">Success</option>\
                                                                            <option value="Cross">Cross</option>\
                                                                        </select>\
                                                                    </div>\
                                                                </div>\
                                                                <div class="col-sm-7">\
                                                                    <div class="form-group mb-2">\
                                                                        <label for="">Pricing Description(EN)</label>\
                                                                            <textarea  name="description[]" class="form-control" required  rows="1"></textarea>\
                                                                            <label for="">Pricing Description(BN)</label>\
                                                                            <textarea  name="descriptionbn[]" class="form-control" required  rows="1"></textarea>\
                                                                    </div>\
                                                                </div>\
                                                                <div class="col-sm-1">\
                                                                    <div class="form-group mb-2 mt-2">\
                                                                        <br>\
                                                                        <button type="button" class="remove-btn btn-sm btn btn-danger"> <i class="bx bx-trash-alt fs-4"></i></button>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                    </div>');
                        });

                    });
                </script>


                <!--************************************
                        ********** Main content END ***********
                        ************************************-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- end main content-->

    @endsection
    @push('admin_style_js')
    @endpush
