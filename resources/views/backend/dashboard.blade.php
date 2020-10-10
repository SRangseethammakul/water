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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                    <a href="{{ route('order.index',['status'=>'รอการยืนยัน'])}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('order.index',['status'=>'รอการจัดส่ง'])}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('store.index')}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('store.staff_index',['status'=>'0'])}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('store.staff_index',['status'=>'1'])}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('store.staff_index',['status'=>'2'])}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">จำนวนร้านค้าแต่ละประเภท</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>

        {{--  --}}

        <div class="row">
            <h5 class="mb-2">สถานะการ Covid-19 ประจำวัน</h5> <h6 class="mb-2 ml-3"> อัพเดทเมื่อ {{$covids->UpdateDate}} กรมควบคุมโรค กระทรวงสาธารณสุข</h6>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-medkit"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ติดเชื้อสะสม</span>
                <span class="info-box-number">{{$covids->Confirmed}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-stethoscope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ผู้ติดเชื้อใหม่</span>
                <span class="info-box-number">{{$covids->NewConfirmed}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-hospital-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">รักษาอยู่ใน รพ.</span>
                <span class="info-box-number">{{$covids->Hospitalized}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">หายแล้ว</span>
                <span class="info-box-number">{{$covids->Recovered}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>
<!-- /.content -->
@endsection
@section('footerscript')
<script>
    $(document).ready(function () {
        var dataPoints = [];
        var dataNames = [];
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var donutData = {
            labels: dataNames,
            datasets: [{
                data: dataPoints,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        });
        $.ajax({
            url: '/api/ajax/coutetype',
            method: 'GET',
            success: function (response) {
                if (response.status) {
                    $.each(response.data, function (index, item) {
                        console.log(item.count, item.name);
                        dataPoints.push(item.count);
                        dataNames.push(item.name);

                    });
                    var donutData = {
                        labels: dataNames,
                        datasets: [{
                            data: dataPoints
                        }]
                    }
                    donutChart.update();
                } else {
                    Swal.fire({
                        title: 'ไม่สำเร็จ กรุณาลองอีกครั้ง',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

</script>
@endsection
