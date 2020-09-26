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
            <div class="container">
                <div class="row">
                    <div class="col-auto mr-auto"><h3>ประเภทร้านค้า</h3></div>
                    <div class="col-auto"><a href="{{ route('storetype.create')}}"> <button type="button" class="btn btn-dark">เพิ่มประเภทร้านค้า</button> </a></div>
                </div>
            </div>

            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">รหัสประเภทร้านค้า</th>
                            <th scope="col">หมวดประเภทร้านค้า</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">วันที่แก้ไข</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><a href="{{ route('storetype.edit',['id'=>$item->id])}}">{{$item->store_type_name}}</a></td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('storetype.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
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
    <script type="text/javascript">
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
                        url: 'api/storetype/destroy',
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