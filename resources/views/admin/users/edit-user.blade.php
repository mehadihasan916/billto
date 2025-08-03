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
                            <h4 class="mb-sm-0 font-size-18">Edit User</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">Name</label>
                                    <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control rounded-pill" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label fw-semibold">Address</label>
                                    <input type="text" class="form-control rounded-pill" id="address" name="address" value="{{ $user->address }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">Phone</label>
                                    <input type="text" class="form-control rounded-pill" id="phone" name="phone" value="{{ $user->phone }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="picture" class="form-label fw-semibold">Picture</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($user->picture__input)
                                            <img src="{{ asset('uploads/userImage/' . $user->picture__input) }}" alt="Picture" width="80" class="rounded shadow-sm border">
                                        @endif
                                        <input type="file" class="form-control" id="picture" name="picture" style="max-width: 200px;">
                                    </div>
                                    @if($user->picture__input)
                                        <small class="text-muted">Current image shown. Upload new to update.</small>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="signature" class="form-label fw-semibold">Signature</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($user->signature)
                                            <img src="{{ asset('uploads/signature/' . $user->signature) }}" alt="Signature" width="80" class="rounded shadow-sm border">
                                        @endif
                                        <input type="file" class="form-control" id="signature" name="signature" style="max-width: 200px;">
                                    </div>
                                    @if($user->signature)
                                        <small class="text-muted">Current signature shown. Upload new to update.</small>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label for="terms" class="form-label fw-semibold">Terms</label>
                                    <textarea class="form-control rounded-3" id="terms" name="terms" rows="3">{{ $user->terms }}</textarea>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-check form-switch">
                                        <input name="email_verified_at" class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" {{ $user->email_verified_at ? 'checked' : '' }} value="1" >
                                        <label class="form-check-label" for="switchCheckDefault" style="user-select: none;">Verified</label>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-pill" id="updateBtn">
                                        <span id="btnText">Update</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@push('admin_js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const btn = document.getElementById('updateBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                btnText.style.display = 'none';
                btnSpinner.style.display = 'inline-block';
                btn.disabled = true;
                setTimeout(() => form.submit(), 500);
            });
        }
    });
</script>
@endpush


@endsection

