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

                        <form action="{{ url('/user-document/update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row   bg-white border_radius mb-2 ">
                                <div class="col-sm-12 mt-4   ">
                                    <div class="row border">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label mt-2">Documents Type</label>
                                                 <select name="document_type_id" id="" class="form-control">
                                                    <option class="text-center" value="">---------Select----------</option>
                                                     @foreach ($documents as $document)
                                                       <option {{ $document->document_type == $join_table_value->document_type ? "selected" : "" }} value="{{ $document->id }}">{{ $document->document_type }}</option>
                                                     @endforeach
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label mt-2">Document image</label>
                                                 <input style="border-radius: 10px !important;" id="imgInp" name="document_image" type="file"  class="form-control " accept="image/*" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                         <div class="mt-3">
                                            <label for="" class="text-center">Preview Document</label>
                                           <img class="mt-3" id="blah_hidden" src="{{ asset('uploads/document/' .$join_table_value->document_image) }}" alt="" style="width:100%; max-height:300px;">

                                            <img class="mt-3 d-none"  width="100%" style="max-height:300px;" id="blah" src="#" alt="Add your signature" />
                                        </div>
                                    </div>
                                        <div class="mb-2">
                                            <input type="hidden" name="hidden_id" value="{{ $join_table_value->id }}">
                                            <button type="submit" class="btn settingUpdatebutton">Update Document</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

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
