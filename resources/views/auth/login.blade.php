@extends('layouts.frontend.app')
@section('title', 'Login Page')
@push('frontend_css')
@endpush
@section('frontend_content')
    <!-- Sub Nav Start -->
    {{-- <section class="sub_nav py-4 border-bottom">
        <div class="">
            <div class="container">
                <div class="nav">
                    <p class="m-0">You are here : <span><a href="#">Home</a> &#8921;</span> <span
                            style="color: #FFB317 !important;">Sign in</span></p>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Sub Nav Start -->

    <!-- Sign in form Start -->
    <section class="form_sign_in">
        <div>
            <div class="container ">
                <div class="text-center">
                    <h2 class="h2_title  mt-4 mb-3 fw-light">{{ __('messages.Welcome_to_Billto') }}</h2>
                    <h2 class="mb-4  fw-bolder" style="color: #000000">{{ __('messages.Signin') }} </h2>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 my-0 mx-auto">
                        <div class="border rounded" style="background: #F0F0F0;">
                            <form method="POST" action="{{ route('login') }}" autocomplete="on">
                                @csrf
                                <div class="pt-4 pb-4 ps-5 pe-5">
                                    @if ($errors->any())
                                        <div>
                                            <div class="fs-5 text-danger">
                                                Whoops! Something went wrong.
                                            </div>

                                            <ul class="mt-3 text-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- Email Address -->
                                    <div class="form-group pb-4">
                                        <label for="email" class="pb-2 " style="font-size: 14px ;">{{ __('messages.Email') }}</label>
                                        <input style="background-color: #FFFFFF; border-radius:10px" type="email"
                                            name="email"
                                            class=" inputPadding border-0 form-control @error('email') is-invalid @enderror"
                                            required autofocus id="email" aria-describedby="emailHelp">
                                    </div>
                                    <!-- Password -->
                                    {{-- <div class="form-group pb-3">
                                        <label for="password" class="pb-2 fw-bolder">Password</label>
                                        <input type="password" name="password" required
                                            class="py-2 form-control @error('email') is-invalid @enderror" id="password"
                                            placeholder="Password" autocomplete="current-password">
                                    </div> --}}
                                    <!-- show password -->
                                    <div class="login_oueter">
                                        <div class="form-row">
                                            <label for="email" class="pb-2 " style="font-size: 14px ;">{{ __('messages.Password') }}</label>
                                            <div class="input-group mb-3">
                                                <input style="border-radius: 10px;" type="password" name="password" required
                                                    class="form-control inputPadding border-0 @error('email') is-invalid @enderror"
                                                    id="password" autocomplete="current-password">
                                                <div class=" eye">
                                                    <div class=" inputPadding border-0  eyeColor d-flex align-items-center pe-4"  onclick="password_show_hide();">
                                                        <i class="bi bi-eye" id="show_eye"></i>
                                                        <i class="bi bi-eye-slash d-none" id="hide_eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Remember Me -->
                                    {{-- <div class="mt-1 form-check">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label for="remember_me" class="form-check-label text-sm"> Remember me </label>
                                    </div> --}}

                                    <button type="submit"
                                        class="form_btn mt-3 inputPadding btn btn-dark border-0 w-100 text-bold "
                                        style="background: #FFB317; font-size:14px; border-radius:10px; ">{{ __('messages.Continue') }}</button>

                                    <!--reset password-->
                                    <div class="row mt-2">
                                        <div class="col-md-6 col-sm-12">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="reset color" style="font-size:14px">{{ __('messages.Forgot_Password?') }}</a>
                                        @endif
                                        </div>
                                        <div class="col-md-6 col-sm-12 d-md-flex justify-content-end">
                                            <a style="font-size: 14px"
                                            class="color  " href="{{ route('register') }}">{{ __('messages.Create_an_Account') }}</a>
                                        </div>
                                    </div>
                                    <p class=" mt-2  ">


                                    </p>
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
                                        <p class="text-white"><i class="bi bi-google me-1"></i> {{ __('messages.Sign_in_with_Google') }}</p>
                                   </a>

                                    <!-- facebook	 -->
                                    {{-- <a style="background: #FFB317; font-size:14px; border-radius:10px; " type="button"
                                    class="form_btn mt-3  inputPadding btn btn-dark border-0 w-100 text-bold"
                                    href="/auth/facebook/redirect">
                                    <p class="text-white"><i class="bi bi-facebook me-1"></i> Sign in with Facebook</p>
                                    </a> --}}
                                    <!--text singup -->
                                    {{-- <div class="mt-3 already_billto">
                                        <p class="text-center" style="color: #898989">Don't have an account yet?</p>
                                    </div> --}}

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
