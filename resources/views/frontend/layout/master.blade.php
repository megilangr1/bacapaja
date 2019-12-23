<!DOCTYPE html>
<Html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="Bacapaja - Baca Apa Aja, Disini kamu bisa baca apa aja yang kamu mau." />

		<title>Bacapaja - Baca Apa Aja @if (!Request::is('/')) | @yield('headTitle') @endif </title>

		<link rel="icon" type="image/png" href="{{ asset('') }}images/favicon.ico" sizes="32x32" />
		{{-- <link rel="icon" type="image/png" href="{{ asset('') }}images/favicon-16x16.png" sizes="32x32" /> --}}
    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min.css">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset('') }}other/ckeditor/plugins/prism/lib/prism/prism_patched.min.css">
		<script src="{{ asset('') }}other/ckeditor/plugins/prism/lib/prism/prism_patched.min.js"></script>
</head>

<Body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <div class="content-wrapper mb-2" style="background-color: #ffffff;">
            <div class="content-header" style="padding-bottom: 0px;">
                <div class="container">
                    @include('frontend.layout.header')
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            @yield('content')
                        </div>
                        @include('frontend.layout.rightbar')
                    </div>
                </div>
            </div>
        </div>

        {{-- <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer> --}}
    </div>


    <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('') }}dist/js/adminlte.min.js"></script>

</Body>

</Html>
