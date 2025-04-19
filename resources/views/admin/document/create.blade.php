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
                                    <li class="breadcrumb-item active">Create-document </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!--************************************
                                ********** Main content Start ***********
                                ************************************-->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                  <div class="card">
                                    <h4> Document Type list</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Type name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($documents as $key=> $document)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $document->document_type }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/organization/package/') }}" type="button"
                                                            class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 me-1"> <i
                                                                class="mdi mdi-pencil"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Add Document Type</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/store/document') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="validationCustom03" class="form-label">Document Type</label>
                                        <input type="text" name="document_type" class="form-control"
                                            id="validationCustom02" required>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->

            </div>
        </div>

    </div>
    <!-- end main content-->

@endsection
@push('admin_style_js')
@endpush
