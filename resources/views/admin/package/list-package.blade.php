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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3>Subscription List
                                        <a href="{{ url('admin/package/page') }}"
                                            class="btn btn-primary btn-sm text-white  float-end "> <i
                                                class="bx bx-left-arrow-alt "></i> Add
                                            Suscription Package
                                        </a>
                                    </h3>
                                </div>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Package Name</th>
                                            <th>Package Duration</th>
                                            <th>Package Price</th>
                                            <th>Template Quantity</th>
                                            <th>Limit Invoice Generate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($packages as $package)
                                            <tr>
                                                <td>{{ $package->id }}</td>
                                                <td>{{ $package->packageName }}</td>
                                                <td>{{ $package->packageDuration }}</td>
                                                <td>{{ $package->price }}</td>
                                                <td>{{ $package->templateQuantity }}</td>
                                                <td>{{ $package->limitInvoiceGenerate }}</td>
                                                {{-- <td>{{ $package->status == '1' ? 'Hidden' : 'Visible' }}</td> --}}
                                                <td>
                                                    {{-- <a href="{{ url('admin/package/' . $package->id . '/edit') }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <a href="{{ url('admin/package/' . $package->id . '/delete') }}"
                                                        onclick="return confirm('Are you sure, you want to delete ')"
                                                        class="btn btn-sm btn-danger">delete</a> --}}
                                                    <a href="{{ url('admin/package/' . $package->id . '/addRow') }}"
                                                        type="button"
                                                        class="btn btn-sm btn-primary btn-rounded waves-effect waves-light mb-2 me-1"
                                                        class="btn btn-sm btn-primary"> Add Row</a>

                                                    <a href="{{ url('admin/package/' . $package->id . '/edit') }}"
                                                        type="button"
                                                        class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 me-1"
                                                        class="btn btn-sm btn-success"> <i class="mdi mdi-pencil"></i></a>

                                                    <a type="button"
                                                        href="{{ url('admin/package/' . $package->id . '/delete') }}"
                                                        onclick="return confirm('Are you sure, you want to delete ')"
                                                        class="btn btn-sm mb-2 me-1 btn-danger btn-rounded waves-effect waves-light">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No subscription package Available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
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
