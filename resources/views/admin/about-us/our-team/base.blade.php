@extends('admin.layouts.app-template')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-center">OUR TEAM</h1>
            {{--            <ol class="breadcrumb">--}}
            {{--                <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->--}}
            {{--                --}}{{--<li class="active">Product Mangement</li>--}}
            {{--            </ol>--}}
        </section>
    @yield('action-content')
    <!-- /.content -->
    </div>
    <script src="{{ asset ("admin/js/ajax-aboutUs.js")}}" type="text/javascript"></script>
@endsection