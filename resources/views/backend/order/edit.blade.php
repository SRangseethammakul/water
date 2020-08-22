@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">แก้ไขคำสั่งซื้อสินค้า</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <div id="app">
        <section class="content">
            <div class="container">
                <form method="post" action="{{ route('order.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$order->id}}">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="store_name">ชื่อลูกค้า</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" value="{{$user->name}}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group  mt-3">
                            <label for="order_status">สถานะคำสั่งซื้อ</label>
                            <select class="form-control" id="order_status" name="order_status">
                                <option value="{{ $order->order_status}}">{{ $order->order_status }}</option>
                                <option value="รอการจัดส่ง">รอการจัดส่ง</option>
                                <option value="กำลังจัดสินค้า">กำลังจัดสินค้า</option>
                                <option value="กำลังจัดส่ง">กำลังจัดส่ง</option>
                                <option value="จัดส่งสำเร็จ">จัดส่งสำเร็จ</option>
                                <option value="จัดส่งไม่สำเร็จ">จัดส่งไม่สำเร็จ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm mt-3">
                        <div class="form-group">
                            <label for="order_delivery">วันที่ทำการจัดส่ง</label>
                            <input type="text" class="form-control" id="datepicker" autocomplete="off" name="order_delivery" value="{{ date('d/m/Y', strtotime($order->order_delivery)) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">เพิ่มเติม</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="order_description" rows="3" value="{{ $order->order_description }}">{{ $order->order_description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="sum_total">จำนวนเงิน</label>
                            <input type="text" class="form-control" id="sum_total" name="sum_total" value="{{$order->sum_total}}" readonly>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="container">
                <div class="row">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">จำนวนสินค้า</th>
                                <th scope="col">จำนวนสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_subs as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{$item->product->product_name}}</td>
                                        <td>{{$item->qty}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footerscript')
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
    <script>
        $( "#datepicker" ).datepicker({
            dateFormat : 'dd/mm/yy',
            minDate: 0,
            buttonImageOnly: true,
            buttonText: "Select date"
        });
        $('#product_price').on('input', function() {
            var product_price = $('#product_price').val().replace(/,/g, "").replace(/%/g, "");
            $('#product_price').val(product_price.toString().replace(/[^0-9]/g, ""));
        });
    
    </script>
@endsection

