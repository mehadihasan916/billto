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
                            <h4 class="mb-sm-0 font-size-18">Users</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Users</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- show all users using bootstrap table  --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User List</h4>
                            </div>
                            <div class="card-body">
                                <table id="usersTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Active plan</th>
                                            <th>Price</th>
                                            <th>Total Invoice</th>
                                            <th>Invoice Used</th>
                                            <th>Status</th>
                                            <th>End Date</th>
                                            <th>Join Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td><a href="{{ route('admin.invoice.list', $user->id) }}"><strong>{{ $user->name }}</strong></a></td>
                                                <td>{{ $user->email }}</td>
                                                <td><span class="badge bg-primary">{{ $user->subscription->name ?? 'N/A' }}</span></td>
                                                <td>{{ $user->subscription->price ?? 'N/A' }} $</td>
                                                <td class="text-center ">
                                                    @if($user->subscription)
                                                        <span class="badge bg-success fs-5">{{ $user->subscription->invoice_generate }}</span>
                                                    @else
                                                        <span class="badge bg-warning">No Invoices</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($user->used_invoices)
                                                        <span class="badge bg-info fs-5">
                                                            {{ $user->used_invoices->invoice_count_total }}
                                                        </span>
                                                        @if($user->subscription && $user->subscription->invoice_generate <= $user->used_invoices->invoice_count_total)
                                                                <span class="badge rounded-pill text-bg-warning text-dark  d-block">Limit Over</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-warning">No Invoices Used</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->subscription && $user->subscription->ends_at && now()->lt($user->subscription->ends_at))
                                                        {{-- <span class="badge bg-success text-white">Running</span> --}}
                                                        <button type="button" class="btn btn-info position-relative btn-sm">
                                                            Running <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-2"><span class="visually-hidden">unread messages</span></span>
                                                        </button>
                                                    @elseif($user->subscription && $user->subscription->ends_at)
                                                        <span class="badge bg-danger text-white">Expired</span>
                                                    @else
                                                        <span class="badge bg-warning text-white">N/A</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($user->subscription && $user->subscription->ends_at)
                                                        {{ \Carbon\Carbon::parse($user->subscription->ends_at)->format('Y-m-d') }}
                                                        @php
                                                            $daysLeft = \Carbon\Carbon::now()->diffInDays($user->subscription->ends_at, false);
                                                        @endphp
                                                        @if($daysLeft > 0)
                                                            || <span class="badge  text-bg-primary text-success">{{ $daysLeft }} days left</span>
                                                        @else
                                                            || <span class="badge text-bg-danger text-danger">Expired {{ \Carbon\Carbon::parse($user->subscription->ends_at)->diffForHumans() }}</span>
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $user->created_at->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <div class="gap-2">
                                                        {{-- send expired notification --}}
                                                        @if(!$user->subscription || ($user->subscription->ends_at && now()->gt($user->subscription->ends_at)))
                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-html="true"
                                                                data-bs-content="<strong>Send subscription expired mail</strong><br>{{ optional($user->subscription)->notified == 1 ? 'Already notified' : 'Notify user about expired subscription.' }}">
                                                                <a class="btn btn-sm {{ optional($user->subscription)->notified == 1 ? 'btn-primary' : 'btn-warning' }}"
                                                                    href="{{ route('admin.users.sendExpiredMail', $user->id) }}">
                                                                    <i class="bi bi-envelope-fill"></i> Send Mail
                                                                </a>
                                                            </span>
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function () {
                                                                    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                                                                    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                                                                        return new bootstrap.Popover(popoverTriggerEl)
                                                                    })
                                                                });
                                                            </script>
                                                        @endif


                                                        {{-- edit user  --}}
                                                        <a class="btn btn-success btn-sm" href="{{ route('admin.users.edit', $user->id) }}"> Edit </a>
                                                        {{-- delete user --}}
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end show all users using bootstrap table  --}}




            </div>
        </div>
    </div>



@endsection


@push('admin_js')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<script>

    // DataTable
    new DataTable('#usersTable', {
        scrollX: true,
    });
</script>
@endpush
