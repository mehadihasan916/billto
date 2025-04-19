@extends('layouts.frontend.app')
@section('title', 'User-setting')
@push('frontend_css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,500&display=swap"
        rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!--dashboard custom css-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/datatable_css_custom.css') }}">
@endpush

@section('custom_dash_menu')
    custom_dash_menu
@endsection
@section('setting')
    left_manu
@endsection
@push('frontend_css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush


{{-- home page css  --}}
@section('frontend_content')

    <section class="container-fluid bg-color ">
        <div class="row">
            <div class="col-md-3 col-lg-2 m-0 p-0">
                <!-- user Dashboar sidebar  -->
                @include('frontend.dashboard.inc.sidebar')
                <!-- user Dashboar sidebar  -->
            </div>

            <style>
                .dashboad_card_width {
                    width: 100%;
                    height: 255px;
                }
            </style>
            <div class="col-md-9 col-lg-10 m-0 p-0 mt-1">
                <div class="container-fluid  side-bar_left   overflow_scroll mt-1 ">
                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    @foreach ($user as $item)
                        <form action="{{ url('/all/invoices/user-setting' . $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row   bg-white border_radius mb-2 ">
                                <div class="col-sm-4 mt-4  verticaleHeight verticaleHeight_col_4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card border-0    my-2" style="width: 18rem;">
                                            <div class="card-body p-5" style="margin: 0 auto;">
                                                <label for="picture__input" tabIndex="0">
                                                    <img id="hide_image" class="propic"
                                                        src="{{ asset('uploads/userImage/' . $item->picture__input) }}"
                                                        alt="">
                                                    <span class="picture__image"></span>
                                                    <span class="text_hidden text-warning">{{ __('messages.Edit_your_profile_picture') }}</span>
                                                </label>
                                                <input type="file" name="picture__input" id="picture__input"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="card  " style="width: 18rem; ">
                                            <div class="card-body ">
                                                @if ($item->signature)
                                                    <div class="text-center">
                                                        <img style="width: 100px; height:100px; object-fit:contain;"
                                                            src="{{ asset('uploads/signature/' . $item->signature) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 mt-4  verticaleHeight verticaleHeight_col_8">
                                    <div class="row ">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{__('messages.User_name')}}</label>
                                                <input style="border-radius: 10px !important;" type="text" name="name"
                                                    value="{{ $item->name }}" class="form-control py-2">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{__('messages.Address')}}</label>
                                                <textarea style="border-radius: 10px !important;" type="text" rows="5" name="address" value=""
                                                    class="form-control py-2"> {{ $item->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{__('messages.Phone')}}</label>
                                                <input style="border-radius: 10px !important;" type="text" name="phone"
                                                    value="{{ $item->phone }}" class="form-control py-2">
                                            </div>
                                            <div class="mb-3 ">
                                                <label class="form-label mt-1"> {{__('messages.email')}}</label>
                                                <input style="border-radius: 10px !important;" type="text" name="email"
                                                    value="{{ $item->email }}" class="form-control py-2" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label mt-2">{{__('messages.Signature')}}</label>
                                        <input style="border-radius: 10px !important;" id="imgInp" name="signature" type="file" name="signature" class="form-control " accept="image/*" readonly>
                                                <img class="mt-3 d-none"  width="80px" height="80px" id="blah" src="#" alt="Add your signature" />
                                            </div>

                                        </div>
                                        <div class="mb-2">
                                            <button type="submit" class="btn settingUpdatebutton">{{__('messages.Update_btn')}}</button>
                                            <button type="button" class="btn settingUpdatebutton" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-bs-whatever="@mdo">{{__('messages.Change_password')}}
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
                {{-- Password change modal  --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.Change_password')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/all/invoices/change-password') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="oldPasswordInput" class="form-label">{{__('messages.Old_Password')}}</label>
                                            <input name="old_password" type="password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                id="oldPasswordInput" placeholder="{{__('messages.Old_Password')}}">
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPasswordInput" class="form-label">{{__('messages.New_Password')}}</label>
                                            <input name="new_password" type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="newPasswordInput" placeholder="{{__('messages.New_Password')}}">
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="confirmNewPasswordInput" class="form-label "> {{__('messages.Confirm_New_Password')}}</label>
                                            <input name="new_password_confirmation" type="password" class="form-control"
                                                id="confirmNewPasswordInput" placeholder="{{__('messages.Confirm_New_Password')}}">
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn settingUpdatebutton ms-3">{{__('messages.Update_Password')}}</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script src="{{ asset('js/profileCustom.js') }}"></script>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Sign in form End -->
@endsection
@push('frontend_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                paging: true,
            });
        });
    </script>
@endpush
