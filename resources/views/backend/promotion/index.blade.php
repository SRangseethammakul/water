@extends('layouts.backend')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Promotion</h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<br>
<section class="content" id="app">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h3>ประเภทโปรโมชั่น</h3>
                </div>
                <div class="col-auto"><a href="{{ route('promotion.create')}}"> <button type="button"
                            class="btn btn-dark">เพิ่มโปรโมชัน</button> </a></div>
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">รหัสโปรโมชั่น</th>
                            <th scope="col">ชื่อโปรโมชั่น</th>
                            <th scope="col">ประเภทสินค้า</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotion as $item)
                        <tr>
                            <th scope="row">{{ $item->id}}</th>
                            <td><a href="{{ route('promotion.edit',['id'=>$item->id])}}">{{$item->promotion_name}}</a>
                            </td>
                            <td>{{$item->product->product_name}}</td>
                            <td>{{$item->promotion_price}}</td>
                            <td><input class="chk1" {{$item->promotion_status ? "checked" : ""}} type="checkbox"
                                    data-toggle="toggle" data-on="กำลังใช้งาน" data-off="เลิกใช้งาน"
                                    data-onstyle="success" data-offstyle="danger" data-id="{{$item->id}}">
                            </td>
                            {{-- <td>{{$item->promotion_status ? 'กำลังใช้งาน' : 'เลิกใช้งาน'}}</td> --}}
                            <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('promotion.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                    <li class="fa fa-pencil text-white"></li>
                                </a>
                                <a href="#" class="btn btn-danger btn-delete" data-rowid="{{ $item->id }}"
                                    title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- end row --}}
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footerscript')
<script>
    $(document).ready(function () {
        $('table').DataTable();
              // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData        = {
        labels: [
            'test',
            'IE',
            'FireFox',
            'Safari',
            'Opera',
            'Navigator',
        ],
        datasets: [
          {
            data: [12,5,4,6,3,1],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
    });
    $('.btn-delete').on('click', function () {
        var id = $(this).data('rowid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            focusCancel: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'api/promotion/destroy',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'ลบข้อมูลไม่สำเร็จ!',
                                footer: '<a href>Why do I have this issue?</a>'
                            });
                        }

                    }
                });
            }
        });
    });
    $('.chk1').on('change', function () {
        Swal.fire({
            title: 'ต้องการเปลี่ยนสถานะ ?',
            text: "ยืนยันสถานะ",
            icon: 'warning',
            showCancelButton: true,
            focusCancel: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                var dataId = $(this).attr("data-id");
                $.ajax({
                    url: '/promotion/ajax/updatePublish',
                    method: 'GET',
                    data: {
                        id: dataId,
                        verify: ($(this).prop('checked') ? 1 : 0)
                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                timer: 1000,
                                showConfirmButton: false
                            });
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
            }
        })

    });

</script>
@if(session('feedback'))

<script>
    Swal.fire(
        '{{ session('feedback')}}', //
        'You clicked the button!',
        'success'
    )

</script>
@endif
@endsection
