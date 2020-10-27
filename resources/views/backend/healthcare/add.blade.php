@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่มข้อมูลด้านสุขภาพ</h1>
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
            <form method="post" action="{{ route('healthcare.store')}}" enctype="multipart/form-data">
            @csrf

                <div class="form-group">
                    <label for="healthcare_name">ชื่อ วัคซีน / เซรุ่ม / ยา<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="healthcare_name" name="healthcare_name" required>
                </div>
                <div class="form-group">
                    <label for="symptom">อาการ<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="symptom" name="symptom" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">จำนวนที่ได้รับ</label>
                    <select class="form-control" name="volume" id="exampleFormControlSelect1">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="order_delivery">วันที่ได้รับ</label>
                            <input type="text" class="form-control datepicker" name="banner_startdate" autocomplete="off" name="order_delivery" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="runnumber">ครั้งที่รับ<span style="color: brown">*</span></label>
                    <input type="number" class="form-control" id="runnumber" name="runnumber" required>
                </div>
                <div class="form-group">
                    <label for="hospital">โรงพยาบาล</label>
                    <input type="text" class="form-control" id="hospital" name="hospital" required>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="province-select">จังหวัด</label>
                            <select class="js-example-basic-single" id="province-select" name="province" class="form-control" style="width: 100%">
                                <option selected>เลือกจังหวัด</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">รูปภาพ</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('footerscript')
    <script>
        $(document).ready(function() {
            function matchStart(params, data) {
                params.term = params.term || '';
                if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                    return data;
                }
                return false;
            }
            $('.js-example-basic-single').select2({
                matcher: function(params, data) {
                    return matchStart(params, data);
                }
            });
        });
        $( ".datepicker" ).datepicker({
            dateFormat : 'dd/mm/yy',
            minDate: 0,
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    </script>
@endsection
