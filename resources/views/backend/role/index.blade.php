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
                    <div class="col-auto mr-auto"><h3>เพิ่มบทบาทผู้ใช้งาน</h3></div>
                    <div class="col-auto"><a href="{{ route('role.create')}}"> <button type="button" class="btn btn-dark">เพิ่มประเภทร้านค้า</button> </a></div>
                </div>
            </div>

            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">รหัสลูกค้า</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{$item->name}}</a></td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('role.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
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
        $('.btn-delete').on('click', function() {
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