@extends('layouts.frontend')
@section('content')

<div class="row my-4">
    <!-- /.col-lg-3 -->

    <div class="col-lg-10">

        <h1>ตะกร้าสินค้า</h1>


        @if (count($listCart) > 0)
        <div class="card">
            <table class="table table-hover shopping-cart-wrap">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col" width="120">จำนวน</th>
                        <th scope="col" width="120">ราคา</th>
                        <th scope="col" width="200" class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listCart as $indexKey => $cart)
                    <tr>
                    <td>{{ ++$indexKey }}</td>
                        <td>
                            <figure class="media">
                                <figcaption class="media-body">
                                <h6 class="title text-truncate">{{ $cart->product_name }}</h6>
                                </figcaption>
                            </figure>
                        </td>
                        <td>

                                {{ $cart->pivot->qty }}

                        </td>
                        <td>
                            <div class="price-wrap">
                                <var class="price">฿ {{ $cart->product_price * $cart->pivot->qty }}</var>
                            </div>
                            <!-- price-wrap .// -->
                        </td>
                        <td class="text-right">
                        <a href="{{ route('cart.delete',['product_id' => $cart->id])}}" class="btn btn-outline-danger"> × ลบ</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $sumQty }} ชิ้น</td>
                        <td>฿ {{ $sumProduct }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- card.// -->

        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-3">
                  <h2>ราคาสินค้า</h2>
                </div>
                <div class="col-md-3 offset-md-3">
                    <h2>฿ {{ number_format($sumProduct,2) }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3">
                  <h2>ค่าขนส่ง</h2>
                </div>
                <div class="col-md-3 offset-md-3">
                    <h2>฿ {{ number_format($deliverry,2) }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3">
                  <h2>ส่วนลดค่าขนส่ง</h2>
                </div>
                <div class="col-md-3 offset-md-3">
                    <h2>฿ {{ number_format($discount,2) }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3">
                  <h2>ราคารวม</h2>
                </div>
                <div class="col-md-3 offset-md-3">
                    <h2>฿ {{ number_format($sumPrice,2) }}</h2>
                </div>
            </div>
        </div>
        <div class="text-right">
            
            <a href="{{ route('cart.confirm')}}" class="btn btn-primary btn-lg">ยืนยันการสั่งซื้อ</a>
        </div>

        @else

            <p>--- ยังไม่ได้เลือกสินค้า ---</p>

        @endif


    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->
@endsection
@section('footerscript')
    @if(session('feedback'))
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script>
        Swal.fire(
            '{{ session('feedback')}}', //
            'You clicked the button!',
            'success'
        )
    </script>
    @endif
@endsection