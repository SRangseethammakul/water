@extends('layouts.backend')
@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Banner</h1>
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
                    <div class="col-auto mr-auto"><h3>Banner</h3></div>
                    <div class="col-auto"><a href="{{ route('banner.create')}}"> <button type="button" class="btn btn-dark">เพิ่ม Banner</button> </a></div>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <form id="sortnumber-form">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                <th scope="col">รหัส</th>
                                <th scope="col">ชื่อ Banner</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">วันที่เริ่ม</th>
                                <th scope="col">วันที่สิ้นสุด</th>
                                <th scope="col">วันที่เพิ่ม</th>
                                <th scope="col">Image</th>
                                <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $key => $item)
                                    <tr>
                                        <td><i class="fa fa-bars row-moves sortable-handle"></i></td>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td><a href="{{ route('banner.edit',['id'=> $item->id ])}}">{{$item->banner_name}}</a></td>
                                        <td>{{$item->is_publish ? 'ใช้งาน' : 'เลิกใช้งาน'}}</td>
                                        <td>{{ Carbon::parse($item->banner_startdate)->format('d/m/Y') }}</td>
                                        <td>{{ Carbon::parse($item->banner_enddate)->format('d/m/Y') }}</td>
                                        <td>{{ Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <img src="{{ Storage::disk('do_spaces')->temporaryUrl('banners/'. $item->banner_image, now()->addMinutes(15) ) }}" height="60px"/>
                                        </td>
                                        <td>
                                            <a href="{{ route('banner.edit',['id'=> $item->id ])}}" class="btn btn-info mr-2">
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
                url: '/banner/updatesequence',
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