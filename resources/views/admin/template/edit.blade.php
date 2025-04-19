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
                                <h3 class="mb-4">Edit Invoice Tamplate
                                    <a href="{{ url('admin/manage/template/page') }}"
                                        class="btn btn-danger btn-sm text-white  float-end ">back
                                    </a>
                                </h3>
                                <form action="{{ url('admin/manage/template/' . $invoiceTemplateForEdit->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-8 ">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Template name</label>
                                                <input type="text" value="{{ $invoiceTemplateForEdit->templateName }}"
                                                    name="templateName" class="form-control" id="validationCustom01"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Template Design Html</label>
                                                <div>
                                                    <textarea name="templateDesignHtml" required class="form-control" rows="3">{{ $invoiceTemplateForEdit->templateDesignHtml }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex ">
                                                    <div class="">
                                                        <label class="form-label">Template Image</label>
                                                        <input type="file" name="templateImage" class="form-control"
                                                            id="validationCustom01" required>
                                                    </div>
                                                    <div class=" ms-5">
                                                        <img class=""
                                                            src="{{ asset('/uploads/template/' . $invoiceTemplateForEdit->templateImage) }}"
                                                            width="120px" height="120px" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div>
                                                        <button class="btn btn-primary mt-2" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->

                </div>


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
