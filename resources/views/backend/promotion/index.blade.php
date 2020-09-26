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
@endsection
@section('footerscript')
<script>
    $(document).ready(function () {
        $('table').DataTable();
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
        var dataId = $(this).attr("data-id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
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
