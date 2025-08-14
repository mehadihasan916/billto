@extends('layouts.admin.admin')
@section('title', 'Home Page')

@push('admin_style_css')
{{-- datatable css  --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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
                                <table id="visitorsTable" class="table table-bordered dt-responsive nowrap"
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
                                            @php
                                                $details = json_decode($traffic->details);
                                            @endphp
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
                                                <td>
                                                    @if($details)
                                                        <p> <span class="badge bg-primary">Country</span> : {{ $details->countryName }}  <span class="badge bg-black">City</span> : {{ $details->cityName }}</p>
                                                        <p> <span class="badge bg-primary">Region</span> : {{ $details->regionName }}  <span class="badge bg-black">Region Code</span> : {{ $details->regionCode }}</p>

                                                        <p>
                                                            Latitude: {{ $details->latitude }} |
                                                            Longitude: {{ $details->longitude }}
                                                            <a href="https://www.google.com/maps?q={{ $details->latitude }},{{ $details->longitude }}"
                                                               target="_blank"
                                                               class="btn btn-sm btn-primary">
                                                                <i class="fas fa-map-marker-alt"></i> View on Map
                                                            </a>
                                                        </p>
                                                    @else
                                                        No details available
                                                    @endif
                                                </td>
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
@push('admin_js')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<script>

    // DataTable
    new DataTable('#visitorsTable', {
        scrollX: true,
        pageLength: 100,
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, 'All']
        ],
    });
</script>
@endpush
