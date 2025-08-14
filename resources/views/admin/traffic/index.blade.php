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
                            <h4 class="mb-sm-0 font-size-18">Traffic</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Traffic</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {{-- show table of traffic --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Traffic List</h4>
                                <p class="card-title-desc">All traffic list are shown in this table</p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>IP</th>
                                            <th>User</th>
                                            <th>Details</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($traffics as $key => $traffic)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $traffic->ip }}</td>
                                                <td>
                                                    @if($traffic->user)
                                                        <a href="{{ route('admin.invoice.list', $traffic->user->id) }}">{{ $traffic->user->name }}</a>
                                                    @else
                                                        Unregistered
                                                    @endif
                                                </td>
                                                <td>{{ $traffic->details }}</td>
                                                <td>{{ $traffic->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end table --}}


            </div>
        </div>
    </div>


@endsection
@push('admin_style_js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endpush
