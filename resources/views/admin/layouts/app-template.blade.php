<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>House3D Administrator</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("admin/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset("admin/css/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("admin/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect.
      -->
    <link href="{{ asset("admin/css/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/css/skin-green.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app-template.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/popup.css') }}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Tinymce -->
    <script src="{{ asset ("admin/js/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("admin/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script  src="{{ asset ("admin/js/jquery.dataTables.min.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("admin/js/dataTables.bootstrap.min.js") }}" type="text/javascript" ></script>

    <!-- AdminLTE App -->
    <script src="{{ asset ("admin/js/app.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("admin/js/demo.js") }}" type="text/javascript"></script>
    <script  src="{{ asset ("admin/js/tinymce.min.js") }}" type="text/javascript" ></script>

    <script src="{{ asset ("admin/js/index.js") }}" type="text/javascript"></script>

    <script>
      window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <![endif]-->
  </head>
  <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Main Header -->
    @include('admin.layouts.header')
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    @yield('content')
    <!-- /.content-wrapper -->
    <!-- Footer -->
    @include('admin.layouts.footer')
    </div>
  </body>
  <script src="{{ asset ("admin/js/product-category.js") }}" type="text/javascript"></script>
  <script src="{{ asset ("admin/js/product.js") }}" type="text/javascript"></script>
</html>