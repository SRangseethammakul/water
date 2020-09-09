@extends('layouts.backend')

@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ul class="navbar-nav  float-sm-right">
                            <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>



            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @role('Admin')
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$order_count_wait}}</h3>

                                    <p>จำนวนรายการรอคอนเฟริม</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cart-plus"></i>
                                </div>
                                <a href="{{ route('order.index',['status'=>'รอการยืนยัน'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$order_count_wait_delivery}}</h3>

                                    <p>จำนวนรายการรอการส่ง</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bolt"></i>
                                </div>
                                <a href="{{ route('order.index',['status'=>'รอการจัดส่ง'])}}"class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{$user_count}}</h3>

                                    <p>จำนวน user</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$store_count}}</h3>

                                    <p>จำนวนร้านค้า</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                <a href="{{ route('store.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">ประเภทสินค้า</span>
                                <span class="info-box-number">{{ $type_count }}</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-trophy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">โปรโมชั่น</span>
                                <span class="info-box-number">{{ $promotion_count }}</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    @endrole
                    @role('Staff')
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$staff_store_count_wait}}</h3>

                                    <p>จำนวนร้านค้าที่ดำเนินการ</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <a href="{{ route('store.staff_index',['status'=>'0'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$staff_store_count_con}}</h3>

                                    <p>จำนวนร้านค้าที่ยืนยันแล้ว</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <a href="{{ route('store.staff_index',['status'=>'1'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$staff_store_count_den}}</h3>

                                    <p>จำนวนร้านค้าที่ถูกปฏิเสธ</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exclamation"></i>
                                </div>
                                <a href="{{ route('store.staff_index',['status'=>'2'])}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        

                    </div>
                    @endrole
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">สวัสดีคุณ {{ auth()->user()->name }}</h3>

                                </div>
                                <div class="card-body">
                                    ยิ่งคุณหาร้านค้าได้เยอะ รายได้ของคุณยิ่งเยอะตาม
                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
@endsection