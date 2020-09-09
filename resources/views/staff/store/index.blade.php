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
                    <div class="col-auto mr-auto"><h3>ร้านค้า</h3></div>
                    <div class="col-auto"><a href="{{ route('store.staff_create')}}"> <button type="button" class="btn btn-dark">เพิ่มร้านค้า</button> </a></div>
                </div>
            </div>


            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อร้านค้า</th>
                            <th scope="col">ติดต่อ</th>
                            <th scope="col">ประเภทร้านค้า</th>
                            <th scope="col">วันที่เพิ่ม</th>
                            <th scope="col">ยืนยันร้านค้า</th>
                            <th scope="col">รูปภาพ</th>
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
                                    <td>{{$item->confirm == 1 ? "ยืนยันแล้ว" : ($item->confirm == 2 ? "ถูกปฎิเสธ" : "รอดำเนินการ")}}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/store/'.$item->store_image) }}" width="60">
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
    </script>
@endsection