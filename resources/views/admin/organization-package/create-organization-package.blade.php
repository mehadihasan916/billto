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
                                <div class="card p-2 mt-1">
                                    <h3>Create organization package
                                        <a href="{{ url('admin/organization/package/list') }}"
                                            class="btn btn-primary btn-sm text-white  float-end p-2"> <i class="bx bx-right-arrow-alt"></i> Organization Package List
                                        </a>
                                    </h3>
                                </div>
                                <hr>
                                <form action="{{ url('admin/organization/package/store') }}" method="POST"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Organization Package
                                                    Name</label>
                                                <input type="text" name="organizationPackageName" class="form-control"
                                                    id="validationCustom01" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Organization Package
                                                    Duration</label>
                                                <select class="form-select" name="organizationPackageDuration"
                                                    id="validationCustom03" required>
                                                    <option selected disabled value="">Select package</option>
                                                    <option value="30">One Month</option>
                                                    <option value="90">three Month</option>
                                                    <option value="180">Six Month</option>
                                                    <option value="365">One Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Organization Package
                                                    Price</label>
                                                <input type="number" name="price" class="form-control"
                                                    id="validationCustom02" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Organizatin Tamplate
                                                    Quantity</label>
                                                <input type="number" name="organizationPackageQuantity"
                                                    class="form-control" id="validationCustom02" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Limit Bill
                                                    Generate</label>
                                                <input type="number" name="limitBillGenerate" class="form-control"
                                                    id="validationCustom02" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Organization Employee
                                                    Limitation</label>
                                                <input type="number" name="organizationEmployeeLimitation"
                                                    class="form-control" id="validationCustom02" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h3 class="mb-3">Choose tamplate</h3>

                                        <div class="row">
                                            @foreach ($invoiceTemplates as $invoiceTemplate)
                                                <div class="col-md-4 mb-2">
                                                    <div class=" d-flex">
                                                        <input type="checkbox" name="template[]" value="{{ $invoiceTemplate->id }}"
                                                            style="height: 20px; width:20px">
                                                        <label class="form-label ms-2">{{ $invoiceTemplate->templateName }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

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
