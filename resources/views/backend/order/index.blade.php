@extends('layouts.backend')
@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Order</h1>
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
                <div class="col-auto mr-auto"><h3>รายการสั่งซื้อ</h3></div>
                
            </div>
        </div>
            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">จำนวนสินค้า</th>
                            <th scope="col">จำนวนเงิน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">วันที่ต้องจัดส่ง</th>
                            <th scope="col">วันที่ทำการสั่งซื้อ</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{$item->sum_qty}}</td>
                                    <td>{{$item->sum_total}}</td>
                                    <td>{{$item->order_status}}</td>
                                    <td>{{ Carbon::parse($item->order_delivery)->format('d/m/Y') }}</td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('order.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                            <li class="fa fa-pencil text-white"></li>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-delete" data-rowid="{{ $item->id }}" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
@endsection
@section('footerscript')
    <script>
        $(document).ready(function () {
            $('table').DataTable();
        });
        $('.btn-delete').on('click', function() {
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
                        url: 'api/order/destroy',
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