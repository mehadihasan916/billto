@extends('layouts.admin.admin')
@section('title', 'Home Page')

@push('admin_style_css')
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
                <form action="{{ url('admin/package/addRow') }}" method="POST" >
                    @csrf
                    <section>
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
                                        <input type="hidden" name="subcription_id"  value="{{ $id }}">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group mb-2">
                                        <label for="">Pricing Description(EN)</label>
                                        <textarea name="description[]" class="form-control" required rows="1"></textarea>
                                        <label for="">Pricing Description(BN)</label>
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

                    </section>
                </form>



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
                                                <label for="">Pricing Description</label>\
                                                    <textarea  name="description[]" class="form-control" required  rows="1"></textarea>\
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
