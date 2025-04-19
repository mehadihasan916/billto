@extends('layouts.frontend.app')
@section('title', 'Forget Password')
@push('frontend_css')
    <style>
      body{
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          height: 100vh;
      }
    #auth-card {
          max-width: 450px;
          margin: auto;
      }
    </style>
@endpush
@section('frontend_content')
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="d-flex justify-content-center mb-4 mt-2">
                <x-application-logo style="width: 120px;"  alt="LOGO" />
            </a>
        </x-slot>

        <div class="mb-4 text-muted">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="d-flex justify-content-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
@endsection
@push('frontend_js')

@endpush
