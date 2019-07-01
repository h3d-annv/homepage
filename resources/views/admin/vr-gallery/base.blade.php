@extends('admin.layouts.app-template')
@section('content')
<html>
    <head>
        <link href="{{ asset('admin/css/modal.css') }}" rel="stylesheet" type="text/css" />
{{--        <script src="{{ asset ("admin/js/ajax-vr-gallery.js")}}" type="text/javascript"></script>--}}
    </head>
</html>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-center">VR GALLERY</h1>
    </section>
    @yield('action-content')
    <!-- /.content -->
</div>
<script src="{{ asset ("admin/js/ajax-vr-gallery.js")}}" type="text/javascript"></script>
@endsection