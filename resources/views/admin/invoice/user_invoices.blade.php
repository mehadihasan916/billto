@extends('layouts.admin.admin')
@section('title', 'Invoice List')

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
                            <h4 class="mb-sm-0 font-size-18">Invoice  <a class="ms-2 shadow border border-1 px-2" href="{{ route('admin.users') }}">Back</a></h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('admin/users') }}">Users</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white border-bottom">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-lg">
                                            @if($user->picture__input)
                                                <img src="{{ asset('uploads/userImage/'.$user->picture__input) }}" alt="Profile Photo" class="img-fluid img-thumbnail rounded-circle " style="width:100px; height:100px; object-fit:cover;">
                                            @else
                                                <div class="avatar-title bg-soft-primary text-primary display-4 m-0 rounded-circle">
                                                    <i class="bx bxs-user-circle"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $user->name }}</h5>
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                            <p class="text-muted mb-0">Joined: {{ $user->created_at->format('d M, Y') }}</p>
                                            @if($subscription)
                                                @if($subscription->ends_at < now())
                                                    <p class="text-danger mb-0">Subscription Expired on {{ \Carbon\Carbon::parse($subscription->ends_at)->format('d M, Y') }}</p>
                                                @else
                                                    <p class="text-success mb-0">Subscription Valid till {{ \Carbon\Carbon::parse($subscription->ends_at)->format('d M, Y') }}</p>
                                                @endif
                                                <p class="text-muted mb-0" onclick="copyToClipboard('{{ $user->phone }}')" style="cursor: pointer;" title="Click to copy">Phone: {{ $user->phone }} <i class="fas fa-copy ms-1"></i></p>
                                                <p class="mb-0">Plan: <span class="badge bg-info">{{ $subscription->name }}</span></p>
                                            @else
                                                <p class="text-warning mb-0">No Active Subscription</p>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="d-flex gap-3">
                                        <div class="px-4 py-3 bg-light rounded">
                                            <h6 class="mb-1 text-primary">Total Invoices</h6>
                                            <h4 class="mb-0">{{ $total_invoices }}</h4>
                                        </div>
                                        <div class="px-4 py-3 bg-light rounded">
                                            <h6 class="mb-1 text-success">Total Paid</h6>
                                            <h4 class="mb-0">{{ $total_paid }}</h4>
                                        </div>
                                        <div class="px-4 py-3 bg-light rounded">
                                            <h6 class="mb-1 text-warning">Total Due</h6>
                                            <h4 class="mb-0">{{ $total_due }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="invoice_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Invoice ID</th>
                                            <th>Invoice To</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $invoice->invoice_id ?? 'N/A' }}</td>
                                                <td>{{ $invoice->invoice_to ?? 'N/A' }}</td>
                                                <td>{{ $invoice->invoice_date ?? 'N/A' }}</td>
                                                <td>{{ $invoice->currency ?? '' }} {{ $invoice->total ?? '0' }}</td>
                                                <td>
                                                    @if($invoice->status_due_paid == 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @elseif($invoice->status_due_paid == 'due')
                                                        <span class="badge bg-warning">Due</span>
                                                    @elseif($invoice->status_due_paid == 'draft')
                                                        <span class="badge bg-info">Draft</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ route('invoice.download', $invoice->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                                                    <form action="{{ route('admin.invoice.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this invoice?')"><i class="fas fa-trash"></i></button>
                                                    </form>
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
        </div>
    </div>
@endsection
@push('admin_js')
{{-- datatable js  --}}
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        $('#invoice_table').DataTable({
            responsive: true
        });
    });
</script>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Phone number copied to clipboard!');
        }).catch(function(err) {
            console.error('Failed to copy text: ', err);
        });
    }
</script>
@endpush

