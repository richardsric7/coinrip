
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CoinRip: Cryptocurrency Indexing</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Scripts -->
    @if(\Request::server('HTTP_X_FORWARDED_PROTO') == 'https')
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @else
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <!-- Fonts -->

    <!-- Styles -->
    @if(\Request::server('HTTP_X_FORWARDED_PROTO') == 'https')
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper" id="app" style="overflow-x: hidden">

    <!-- Navbar -->
<main-nav-component></main-nav-component>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
<router-view></router-view>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->

        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date("Y") }} <a href="/">CoinRip</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

</body>
</html>
