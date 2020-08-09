@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">แก้ไขประเภทสินค้า</h1>
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
            <form method="post" action="{{ route('storetype.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" value="{{$type->id}}">
                <div class="form-group mt-5">
                    <label for="storetype_name">ชื่อประเภทสินค้า</label>
                    <input type="text" class="form-control" id="storetype_name" name="storetype_name" required value="{{ $type->store_type_name }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
