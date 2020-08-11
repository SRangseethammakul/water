@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่มโปรโมชัน</h1>
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
            <form method="post" action="{{ route('product.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="form-group  mt-5">
                    <label for="product_typeSelect1">เลือกประเภทสินค้า</label>
                    <select class="form-control"  id="product_typeSelect1" name="product_type">
                    @foreach ($types as $item)
                        <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_name">ชื่อสินค้า</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_detail">รายละเอียดสินค้า</label>
                    <input type="text" class="form-control" id="product_detail" name="product_detail">
                </div>
                <div class="form-group">
                    <label for="product_price">ราคาสินค้า</label>
                    <input type="text" class="form-control" id="product_price" name="product_price">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="product_status_1" value="1" name="product_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="product_status_1">ใช้งาน</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="product_status_2" value="0" name="product_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="product_status_2">เลิกใช้งาน</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productimage">รูปสินค้า</label>
                    <input type="file" class="form-control-file" id="productimage" name="productimage">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('footerscript')
    <script>
        $('#product_price').on('input', function() {
            var product_price = $('#product_price').val().replace(/,/g, "").replace(/%/g, "");
            $('#product_price').val(product_price.toString().replace(/[^0-9]/g, ""));
        });
    
    </script>
@endsection
