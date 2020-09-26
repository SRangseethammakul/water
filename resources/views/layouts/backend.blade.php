<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Store System | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- This page and all of the switch buttons shown are running on Bootstrap 4.3 --}}
    <link rel="stylesheet" href="/css/bootstrap4-toggle-3.6.1/bootstrap4-toggle.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>


            </ul>

            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/water.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Store System</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-header">ข้อมูลหลัก</li>
                        @role('Admin')
                        <li class="nav-item">
                            <a href="{{ route('type.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-cart-plus"></i> ประเภทสินค้า</a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('product.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-tags"></i> รายการสินค้า
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('storetype.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-cubes"></i> ประเภทร้านค้า
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('promotion.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-bolt"></i> โปรโมชัน
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('store.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-shopping-bag"></i> ร้านค้า
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('user.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-users"></i> ผู้ใช้งาน
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('order.index')}}" class="nav-link">
                                <i class="nav-icon fa fa-calendar-check-o"></i> คำสั่งซื้อ ออนไลน์
                            </a>
                        </li>
                        @endrole
                        @role('Staff')
                        <li class="nav-item has-treeview">
                            <a href="{{ route('store.staff_index')}}" class="nav-link">
                                <i class="nav-icon fa fa-book"></i> ร้านค้า
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('store.staff_create')}}" class="nav-link">
                                <i class="nav-icon fa fa-shopping-bag"></i> เพิ่มร้านค้า
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item has-treeview">
                            <a href="{{ route('welcome')}}" class="nav-link">
                                <i class="nav-icon fa fa-compass"></i> กลับหน้าโชว์สินค้า
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->
            @yield('content')
            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Store System Management</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.2-alpha
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/Chart.min.js')}}"></script>
    {{-- This page and all of the switch buttons shown are running on Bootstrap 4.3 --}}
    <script src="/js/bootstrap4-toggle-3.6.1/bootstrap4-toggle.js"></script>
    @yield('footerscript')

</body>

</html>
