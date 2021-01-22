@extends('layouts.backend')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">ประเภทร้านค้า</h1>
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

        <div class="row">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">รหัสลูกค้า</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">Email</th>
                            <th scope="col">สถานนะ</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{$item->name}}</a></td>
                            <td>{{ $item->email }}</td>
                            <td><input class="chk1" {{$item->user_verify ? "checked" : ""}} type="checkbox"
                                    data-toggle="toggle" data-on="ปกติ" data-off="ระงับการใช้งาน" data-onstyle="success"
                                    data-offstyle="danger" data-id="{{$item->id}}">
                            </td>
                            {{-- <td>{{ $item->user_verify ? 'ปกติ' : 'ระงับการใช้งาน' }}</td> --}}
                            <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('user.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                    <li class="fa fa-pencil text-white"></li>
                                </a>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('table').DataTable();
    });
    $('.chk1').on('change', function () {
        var dataId = $(this).attr("data-id");
        $.ajax({
            url: '/user/ajax/updatePublish',
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
        '{{ session(' feedback')}}', //
        'You clicked the button!',
        'success'
    )

</script>
@endif
@endsection
