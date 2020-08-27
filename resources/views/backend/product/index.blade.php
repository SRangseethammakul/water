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
                    <form id="sortnumber-form">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
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
                                        <td><i class="fa fa-bars row-moves sortable-handle"></i></td>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td><a href="{{ route('product.edit',['id'=>$item->id])}}">{{$item->product_name}}</a></td>
                                        <td>{{$item->product_price}}</td>
                                        <td>{{$item->type->type_name}}</td>
                                        <td>
                                            <img class="img-responsive" height="60px" src="{!! Storage::disk('do_spaces')->url('products/' . $item->product_image) !!}" alt="thumb">
                                        </td>
                                        <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('product.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                                <li class="fa fa-pencil text-white"></li>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-delete" data-rowid="{{ $item->id }}" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        <input class="sortnumber" type="hidden" name="sequence[{{ $item->id }}]" value="{{ $item->sort_order }}">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
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
    $('tbody').sortable({
        update: function(event, ui) {
            $('.sortnumber').each(function (index) {
                index++;
                $(this).val(index);
            });
            $.ajax({
                url: '/product/updatesequence',
                method: 'GET',
                enctype: 'application/x-www-form-urlencoded',
                data: $('#sortnumber-form').serialize(),
                success: function (response) {
                    if (response.status) {
                    } else {
                    }
                }
            });
        },
        handle: '.sortable-handle'
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
                    url: 'api/product/destroy',
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