@extends('layouts.frontend.app')
@section('title', 'Register-page')
@push('frontend_css')
@endpush
@section('frontend_content')
    <!-- Sub Nav Start -->
    <!-- Sign in form Start -->
    <section class="form_sign_in">
        <div>
            <div class="container mb-4">
                <div class="text-center ">
                    <h2 class="h2_title  mt-4 mb-3 fw-light">{{ __('messages.Welcome_to_Billto') }} </h2>
                    <h2 class="mb-4  fw-bolder" style="color: #000000">{{ __('messages.Sign_up') }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-6 my-0 mx-auto">
                        <div class="border rounded" style="background: #F0F0F0;">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="p-5">
                                    <!-- Name -->
                                    <div class="form-group pb-3">
                                        <label for="name" class="pb-2 " style="font-size: 14px;">{{ __('messages.Full_Name') }}</label>
                                        <input style="background-color: #FFFFFF; border-radius:10px" id="name"
                                            type="text"
                                            class=" inputPadding form-control @error('name')  is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Email Address -->
                                    <div class="form-group pb-3">
                                        <label for="email" class="pb-2" style="font-size: 14px;">{{ __('messages.Email') }}</label>
                                        <input style="background-color: #FFFFFF; border-radius:10px" id="email"
                                            type="email" name="email" value="{{ old('email') }}"
                                            class="inputPadding form-control @error('email')  is-invalid @enderror"
                                            required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <style>
                                        .pe_4_custom{
                                            padding-right: 2.1rem!important;
                                        }
                                    </style>
                                    <!-- Password -->
                                    <div class="form-row pb-3">
                                        <label for="password" class="pb-2" style="font-size: 14px;">{{ __('messages.Password') }}</label>
                                        <div class="input-group mb-1">
                                            <input style="background-color: #FFFFFF; border-radius:10px" id="password"
                                                type="password" name="password"
                                                class="inputPadding form-control @error('password')  is-invalid @enderror"
                                                required autocomplete="new-password">
                                            <div class=" eye">
                                                <div class=" inputPadding border-0  eyeColor d-flex align-items-center  pe_4_custom"
                                                    onclick="password_show_hide();">
                                                    <i class="bi bi-eye" id="show_eye"></i>
                                                    <i class="bi bi-eye-slash d-none" id="hide_eye"></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-none text-danger" id="password_not_con">
                                            <small class="p-0 m-0" style="font-size: 13px;"> {{ __('messages.Password_and_confirm_password_not_match') }}</small>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- niye aschi --}}

                                    <!-- Confirm Password -->
                                    <div class="form-group pb-1">
                                        <label for="password_confirmation" class="pb-2" style="font-size: 14px;">{{ __('messages.Confirm_Password') }} </label>
                                        <input style="background-color: #FFFFFF; border-radius:10px"
                                            id="password_confirmation" type="password" name="password_confirmation"
                                            class="inputPadding form-control @error('password_confirmation')  is-invalid @enderror" required>
                                      @error('password_confirmation')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <p class="BetweeenChatac">{{ __('messages.Between_8_and_72_characters') }} </p>

                                    <!--continue -->
                                    <button type="submit" id="register_btn_sbmt"
                                        class="form_btn mt-4 inputPadding btn btn-dark border-0 w-100 text-bold disabled"
                                        style="background: #FFB317; font-size:14px; border-radius:10px; ">{{ __('messages.Continue') }} </button>

                                    <div class="mt-3 mb-4"
                                        style="width: 100%; height: 20px; border-bottom: 0.5px solid #CCCCCC; text-align: center">
                                        <span style="font-size: 14px; background-color: #F0F0F0; color:#CCCCCC;">
                                            or
                                        </span>
                                    </div>

                                    <!-- google	 -->
                                    <a style="background: #FFB317; font-size:14px; border-radius:10px; " type="button"
                                        class="form_btn my-3 inputPadding btn btn-dark border-0 w-100 text-bold"
                                        href="/auth/google/redirect">
                                        <p class="text-white"><i class="bi bi-google me-1"></i> {{ __('messages.Sign_in_with_Google') }} </p>
                                    </a>

                                    <!-- facebook	 -->
                                    {{-- <a style="background: #FFB317; font-size:14px; border-radius:10px; " type="button"
                                        class="form_btn mt-3  inputPadding btn btn-dark border-0 w-100 text-bold"
                                        href="/auth/facebook/redirect">
                                        <p class="text-white"><i class="bi bi-facebook me-1"></i> Sign in with Facebook</p>
                                    </a> --}}
                                    <div class="my-3 already_billto">
                                        <p class="allreadyOnBillto">{{ __('messages.Already_on_Billto') }}  <a class="BetweeenChatac"
                                                href="{{ route('login') }}"> {{ __('messages.Sign_in_here') }} </a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Sign in form End -->
@endsection
@push('frontend_js')
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endpush
