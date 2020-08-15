@extends('layouts.backend')
@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Product</h1>
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
                <div class="col-auto"><a href="{{ route('product.create')}}"> <button type="button" class="btn btn-dark">เพิ่มสินค้า</button> </a></div>
            </div>
        </div>
            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">รูปภาพ</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td><a href="{{ route('product.edit',['id'=>$item->id])}}">{{$item->product_name}}</a></td>
                                    <td>{{$item->product_price}}</td>
                                    <td>{{$item->type->type_name}}</td>
                                    <td>
                                        <img class="img-responsive" height="60px" src="{!! Storage::disk('do_spaces')->url('products/' . $item->product_image) !!}" alt="thumb">
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{ route('product.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                            <li class="fa fa-pencil text-white"></li>
                                        </a>
                                        <a href="{{ url('product/destroy/'.$item->id)}}">
                                            <button class="btn btn-danger" name="archive" type="submit">
                                                <i class="fa fa-archive"></i>
                                                    ลบข้อมูล
                                            </button>
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