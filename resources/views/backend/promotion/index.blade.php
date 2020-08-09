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
                <div class="col-auto mr-auto"><h3>ประเภทโปรโมชั่นทั้งหมด 10 รายการ</h3></div>
                <div class="col-auto"><a href="{{ route('promotion.create')}}"> <button type="button" class="btn btn-dark">Dark</button> </a></div>
            </div>
        </div>
            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">รหัสโปรโมชั่น</th>
                            <th scope="col">ชื่อโปรโมชั่น</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">วันที่แก้ไข</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotion as $item)
                                <tr>
                                    <th scope="row">{{ $item->id}}</th>
                                    <td><a href="{{ route('promotion.edit',['id'=>$item->id])}}">{{$item->promotion_name}}</a></td>
                                    <td>{{$item->type->type_name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('promotion.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                            <li class="fa fa-pencil text-white"></li>
                                        </a>
                                        <button class="btn btn-danger" name="archive" type="submit" onclick="archiveFunction()">
                                            <i class="fa fa-archive"></i>
                                                Archive
                                        </button>
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
<script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script>
        function archiveFunction() {
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
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        }
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