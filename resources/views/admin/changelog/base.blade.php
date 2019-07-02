@extends('admin.layouts.app-template')
@section('content')
    <html>
    <head>
        <link href="{{ asset('admin/css/modal.css') }}" rel="stylesheet" type="text/css" />
        <script src="../../vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    </head>
    </html>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-center">CHANGELOG</h1>
        </section>
    @yield('action-content')
    <!-- /.content -->
    </div>
    <script src="{{ asset ("admin/js/ajax-changelog.js")}}" type="text/javascript"></script>
@endsection
