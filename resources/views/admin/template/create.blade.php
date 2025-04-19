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
                                <h3 class="mb-3">Create Tamplate</h3>
                                <form action="{{ url('admin/manage/template/store') }}" method="POST" enctype="multipart/form-data" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-8">
                                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Package Name</th>
                                                        <th>Template Image</th>
                                                        <th>Template Design Html</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                    @forelse ($invoiceTemplates as $invoiceTemplate)
                                                        <tr>
                                                            <td>{{ $count++; }}</td>
                                                            <td>{{ $invoiceTemplate->templateName }}</td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <img width="80px" height="80px" src="{{ asset('/uploads/template/'.$invoiceTemplate->templateImage) }}" alt="">
                                                                </div>
                                                            </td>
                                                            <td>{{ $invoiceTemplate->templateDesignHtml }}</td>
                                                            {{-- <td>{{ $package->status == '1' ? 'Hidden' : 'Visible' }}</td> --}}
                                                            <td>
                                                                <a href="{{ url('admin/manage/template/' . $invoiceTemplate->id . '/edit') }}"
                                                                    type="button"
                                                                    class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 me-1"
                                                                    class="btn btn-sm btn-success"> <i class="mdi mdi-pencil"></i></a>
                                                                <a type="button"
                                                                    href="{{ url('admin/manage/template/' . $invoiceTemplate->id . '/delete') }}"
                                                                    onclick="return confirm('Are you sure, you want to delete ')"
                                                                    class="btn btn-sm mb-2 me-1 btn-danger btn-rounded waves-effect waves-light">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7">No Template Invoice Available</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                            <div class="">
                                                {{ $invoiceTemplates->links() }}
                                            </div>
                                        </div>
                                        <div class="col-4 ">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Template name</label>
                                                <input type="text" name="templateName" class="form-control"
                                                    id="validationCustom01" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Template Design Html</label>
                                                <div>
                                                    <textarea name="templateDesignHtml"  required class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Template Image</label>
                                                <div>
                                                    <input type="file" name="templateImage" class="form-control"
                                                    id="validationCustom01" required>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div>
                                                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
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
