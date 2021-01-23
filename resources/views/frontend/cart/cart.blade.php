@extends('layouts.frontend')
@section('content')

<div class="row my-4">
    <!-- /.col-lg-3 -->

    <div class="col-lg-10">

        <h1>ตะกร้าสินค้า</h1>


        @if (count($listCart) > 0)
        <div class="card">
            <div class="table-responsive-lg">
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
                                <a href="{{ route('cart.delete',['product_id' => $cart->id])}}"
                                    class="btn btn-outline-danger"> × ลบ</a>
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
        </div>


        <div class="container">
            <form enctype="multipart/form-data" id="checkOutForm">
                <a href="{{ route('profile.create') }}" class="btn btn-primary mt-3 mb-3">เพิ่มที่อยู่</a>
                @if($profiles)
                <div class="form-group">
                    <label for="profileselect">ที่อยู่ในการจัดส่ง</label>
                    <select class="form-control" name="profileselect" id="profileselect">
                        @foreach ($profiles as $item)
                        <option value={{$item->id}}>{{$item->first_name}} {{$item->last_name}} {{$item->profile_tel }}
                            {{$item->profile_address }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
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
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="paymeny_status_1" value="1" name="paymeny_status"
                            class="custom-control-input" required checked="checked">
                        <label class="custom-control-label" for="paymeny_status_1">จ่ายเงินทันที</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="paymeny_status_2" value="0" name="paymeny_status"
                            class="custom-control-input" required>
                        <label class="custom-control-label" for="paymeny_status_2">จ่ายเงินปลายทาง</label>
                    </div>
                </div>
                <div class="container" id="payment_item">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#paymentModal">
                        แสดง QR
                    </button>
                    <div class="show-image">
                        <img id="edit-image-store" width="90%" height="40%">
                    </div>
                    <div class="form-group">
                        <label for="payment_img">รูปสลิป</label>
                        <input type="file" class="form-control-file text-center" onchange="readURL(this);" id="payment_img"
                            name="payment_img">
                    </div>
                </div>
                <div class="text-right">
                    <a id="saveBtn" class="btn btn-primary btn-lg">ยืนยันการสั่งซื้อ</a>
                </div>
            </form>
        </div>

        @else

        <p>--- คุณยังไม่มีสินค้าในตะกร้า ---</p>

        @endif


    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">จ่ายเงิน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 offset-md-2">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/payment_qr.jpg') }}" class="card-img-top">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" class="form-control mb-2" value="4063043952" readonly
                                                    id="myInput" style="text-align:right;">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" onclick="myFunction()"
                                                    class="btn btn-info btn-block">คัดลอกเลขบัญชี</button>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <a href="{{ asset('images/payment_qr.jpg') }}" download
                                                    class="btn btn-success btn-block" role="button">บันทึกรูปภาพ</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footerscript')
<script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#saveBtn').on('click', function (e) {
        event.preventDefault();
        var formData = new FormData();
        var files = $('#payment_img')[0].files;
        var profileselect = $('#profileselect').val();
        var paymeny_status = $("input:radio[name=paymeny_status]:checked").val(); 
        formData.append('payment_img', files[0]);
        formData.append('profileselect', profileselect);
        formData.append('paymeny_status', paymeny_status);
        $.ajax({
            type: "POST",
            data: formData,
            url: "{{ route('cart.newConfirm') }}",
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    Swal.fire(
                            'สั่งซื้อสำเร็จ', //
                            'จัดส่งสินค้าภายใน ' + response.day,
                            'success'
                        ).then((result) => {
                            window.location = '/';
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'สั่งซื้อไม่สำเร็จ!',
                        footer: '<a href>Why do I have this issue?</a>'
                    });
                }
            },
            error: function (response) {
                $('#saveBtn').html('Save Changes');
            }
        });
    });
    /*
    function startSearch() {
        var profile = $('#profileselect').val();
        let payment_status = $('#paymeny_status_1').val();
        debugger;
        var fd = new FormData();
        var files = $('#payment_img')[0].files;
        fd.append('file',files[0]);
        console.log(payment_status);
        console.log(fd);
        console.log('length : ', files.length);
        if (profile) {
            $.ajax({
                url: '/cart/checkout/cart',
                method: 'GET',
                data: {
                    profile: profile,
                    fd : fd
                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire(
                            'สั่งซื้อสำเร็จ', //
                            'จัดส่งสินค้าภายใน ' + response.day,
                            'success'
                        ).then((result) => {
                            window.location = '/';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'สั่งซื้อไม่สำเร็จ!',
                            footer: '<a href>Why do I have this issue?</a>'
                        });
                    }

                }
            });
        } else {
            Swal.fire(
                'คุณยังไม่มีที่อยู่ในการจัดส่ง',
                'โปรดเพิ่มที่อยู่ให้เราหน่อย',
                'question'
            ).then((result) => {
                window.location = '/../../profile/create';
            });
        }
    }
    */
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        Swal.fire({
            icon: 'success',
            title: 'คัดลอกแล้ว',
            showConfirmButton: false,
            timer: 1500
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#edit-image-store').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#paymeny_status_1').click(function (e) {
        $('#payment_item').css('display', 'block');
    });
    $('#paymeny_status_2').click(function (e) {
        $('#payment_item').css('display', 'none');
    });

</script>
@if(session('feedback'))

<script>
    Swal.fire(
        '{{ session('feedback')}}', //
        'You clicked the button!',
        'success'
    );
</script>
@endif
@endsection
