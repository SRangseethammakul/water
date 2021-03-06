@extends('layouts.backend')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Type</h1>
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
                    <div class="col-auto mr-auto"><h3>ประเภทสินค้า</h3></div>
                    <div class="col-auto"><a href="{{ route('type.create')}}"> <button type="button" class="btn btn-dark">เพิ่มประเภทสินค้า</button> </a></div>
                </div>
            </div>

            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">หมวดสินค้า</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">วันที่แก้ไข</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $item)
                                <tr>
                                    <th scope="row">{{ $item->id}}</th>
                                    <td><a href="{{ route('type.edit',['id'=>$item->id])}}">{{$item->type_name}}</a></td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('type.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
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
                        url: '/api/type/destroy',
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
                '{{ session('feedback')}}',
                'You clicked the button!',
                'success'
            )
        </script>
    @endif
@endsection