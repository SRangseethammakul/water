@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">แก้ไขโปรโมชัน</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <div id="app">
        <section class="content">
            <div class="container">
                <form method="post" action="{{ route('promotion.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <input type="hidden" name="id" value="{{$promotion->id}}">
                    <div class="form-group  mt-5">
                        <label for="exampleFormControlSelect1">เลือกประเภทสินค้า</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="promotion_type">
                            <option value="{{ $promotion->product_id}}">{{ $promotion->product->product_name }}</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="promotion_name">ชื่อโปรโมชั่น</label>
                        <input type="text" class="form-control" id="promotion_name" name="promotion_name" value="{{ $promotion->promotion_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="promotion_detail">รายละเอียดโปรโมชั่น</label>
                        <input type="text" class="form-control" id="promotion_detail" name="promotion_detail" value="{{ $promotion->promotion_detail }}">
                    </div>
                    <div class="form-group">
                        <label for="promotion_price">ราคาโปรโมชั่น</label>
                        <input type="text" class="form-control" id="promotion_price" name="promotion_price" value="{{ $promotion->promotion_price }}">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="promotion_status_1" value="1" name="promotion_status" class="custom-control-input" {{ ($promotion->promotion_status=="1")? "checked" : "" }} required>
                            <label class="custom-control-label" for="promotion_status_1">ใช้งาน</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="promotion_status_2" value="0" name="promotion_status" class="custom-control-input" {{ ($promotion->promotion_status=="0")? "checked" : "" }} required>
                            <label class="custom-control-label" for="promotion_status_2">เลิกใช้งาน</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('footerscript')
    <script>
        $('#promotion_price').on('input', function() {
            var promotion_price = $('#promotion_price').val().replace(/,/g, "").replace(/%/g, "");
            $('#promotion_price').val(promotion_price.toString().replace(/[^0-9]/g, ""));
        });
    
    </script>
@endsection

