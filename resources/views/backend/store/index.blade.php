@extends('layouts.backend')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Store</h1>
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
                    <h3>ร้านค้า</h3>
                </div>
                <div class="col-auto"><a href="{{ route('store.create')}}"> <button type="button"
                            class="btn btn-dark">เพิ่มร้านค้า</button> </a></div>
            </div>
        </div>


        <div class="row">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">รหัสร้านค้า</th>
                            <th scope="col">ชื่อร้านค้า</th>
                            <th scope="col">ติดต่อ</th>
                            <th scope="col">ประเภทร้านค้า</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">รูปภาพ</th>
                            <th scope="col">สถานะร้านค้า</th>
                            <th scope="col">การยืนยัน</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($store as $key => $item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{$item->store_name}}</td>
                            <td>{{$item->store_contact}}</td>
                            <td>{{$item->store_type->store_type_name}}</td>
                            <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <img src="{{ asset('storage/images/store/'.$item->store_image) }}" width="60">
                            </td>
                            <td><input class="chk1" {{$item->store_status ? "checked" : ""}} type="checkbox"
                                    data-toggle="toggle" data-on="ปกติ" data-off="ระงับการขาย" data-onstyle="success"
                                    data-offstyle="danger" data-id="{{$item->id}}">
                            </td>
                            <td>{{$item->confirm ? "ยืนยันแล้ว" : "รอดำเนินการ"}}</td>
                            <td>
                                <a href="{{ route('store.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
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
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'api/store/destroy',
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
        $.ajax({
            url: '/store/ajax/updatePublish',
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
    });

</script>
@if(session('feedback'))

<script>
    Swal.fire(
        '{{ session('
        feedback ')}}', //
        'You clicked the button!',
        'success'
    )

</script>
@endif
@if(session('unsuccess'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('
        unsuccess ')}}'
    })

</script>
@endif
@endsection
