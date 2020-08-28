@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่ม Banner</h1>
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
            <form method="post" action="{{ route('banner.store')}}" enctype="multipart/form-data">
            @csrf

                <div class="form-group">
                    <label for="banner_name">ชื่อ Banner <span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="banner_name" name="banner_name" required>
                </div>
                <div class="form-group">
                    <label for="banner_url">LINK Banner</label>
                    <input type="text" class="form-control" id="banner_url" name="banner_url" placeholder="www.google.com">
                </div>
                <div class="form-group">
                    <label for="banner_description">รายละเอียด Banner</label>
                    <input type="text" class="form-control" name="banner_description">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="banner_status_1" value="1" name="banner_is_publish" class="custom-control-input" required>
                        <label class="custom-control-label" for="banner_status_1">ใช้งาน</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="banner_status_2" value="0" name="banner_is_publish" class="custom-control-input" required>
                        <label class="custom-control-label" for="banner_status_2">เลิกใช้งาน</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="order_delivery">วันที่เริ่มต้น</label>
                            <input type="text" class="form-control datepicker" name="banner_startdate" autocomplete="off" name="order_delivery" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="order_delivery">วันที่สิ้นสุด</label>
                            <input type="text" class="form-control datepicker" name="banner_enddate" autocomplete="off" name="order_delivery" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">รูปภาพ</label>
                    <input type="file" class="form-control-file" name="banner_image" id="exampleFormControlFile1" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('footerscript')
    <script>
        $( ".datepicker" ).datepicker({
            dateFormat : 'dd/mm/yy',
            minDate: 0,
            buttonImageOnly: true,
            buttonText: "Select date"
        });
        $('#banner_price').on('input', function() {
            var banner_price = $('#banner_price').val().replace(/,/g, "").replace(/%/g, "");
            $('#banner_price').val(banner_price.toString().replace(/[^0-9]/g, ""));
        });
    
    </script>
@endsection
