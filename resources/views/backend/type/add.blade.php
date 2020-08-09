@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่มประเภทสินค้า</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <section class="content" id="app">
        <div class="container">
            <form method="post" action="{{ route('type.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="form-group mt-5">
                    <label for="type_name">ชื่อประเภทสินค้า</label>
                    <input type="text" class="form-control" id="type_name" name="type_name" required>
                </div>
                <div class="form-group">
                    <label for="type_detail">รายละเอียดสินค้า</label>
                    <input type="text" class="form-control" id="type_detail" name="type_detail">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="type_status_1" value="1" name="type_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="type_status_1">ใช้งาน</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="type_status_2" value="0" name="type_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="type_status_2">เลิกใช้งาน</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
