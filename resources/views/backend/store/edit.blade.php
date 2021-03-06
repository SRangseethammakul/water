@extends('layouts.backend')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">แก้ไขร้านค้า</h1>
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
        <form method="post" action="{{ route('store.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$store->id}}">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_name">ชื่อร้านค้า <Span style="color: red">*</Span></label>
                        <input type="text" class="form-control" id="store_name" name="store_name"
                            value="{{ $store->store_name }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_contact">ชื่อลูกค้า <Span style="color: red">*</Span></label>
                        <input type="text" class="form-control" id="store_contact" name="store_contact"
                            value="{{ $store->store_contact }}" required>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">เลือกประเภทร้านค้า</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="store_type" required>
                            <option value="{{ $store->store_type_id}}">{{ $store->store_type->store_type_name }}
                            </option>
                            @foreach ($store_types as $item)
                            <option value="{{ $item->id }}">{{ $item->store_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_tel">เบอร์ร้านค้า <Span style="color: red">*</Span></label>
                        <input type="text" class="form-control" id="store_tel" name="store_tel" maxlength="10"
                            value="{{ $store->store_tel }}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_line">Line ID</label>
                        <input type="text" class="form-control" id="store_line" name="store_line"
                            value="{{ $store->store_lineid }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">ที่อยู่ร้านค้า</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="store_address" rows="3"
                            value="{{ $store->store_address }}">{{ $store->store_address }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" class="form-control" id="store_lat" name="store_lat" value="{{ $store->store_lat }}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" class="form-control" id="store_lng" name="store_lng" value="{{ $store->store_lng }}">
                    </div>
                </div>
                <div class="col-sm">
                    <button onclick="getLocation()" type="button" class="btn btn-success btn-block" id="get_ltlng" data-toggle="button" aria-pressed="false">
                        ค้นหาพิกัดร้านค้า
                    </button>
                </div>
            </div>
            @foreach($promotions as $infraction)
            <div class="row">
                <div class="col-sm">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="check_list[]" type="checkbox"
                            id="inlineCheckbox{{ $infraction->id }}" value="{{ $infraction->id }}"
                            {{ in_array($infraction->id, $store_promotion)? "checked" : "" }}
                            style="width: 20px;height: 20px;">
                        <label class="form-check-label ml-5"
                            for="inlineCheckbox{{ $infraction->id }}">{{$infraction->promotion_name }} ราคา :
                            {{$infraction->promotion_price }}</label>
                    </div>
                </div>
            </div>
            @endforeach


            <div class="form-group">
                <label for="store_detail">รายละเอียด ร้านค้า</label>
                <textarea class="form-control" id="store_detail" name="store_detail" rows="3"
                    value="{{ $store->store_detail }}">{{ $store->store_detail }}</textarea>
            </div>
            <div class="form-group">
                <h5>สถานนะของร้านค้า <Span style="color: red">*</Span></h5>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="store_status_1" value="1" name="store_status" class="custom-control-input"
                        {{ ($store->store_status=="1")? "checked" : "" }}>
                    <label class="custom-control-label" for="store_status_1">ใช้งาน</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="store_status_2" value="0" name="store_status" class="custom-control-input"
                        {{ ($store->store_status=="0")? "checked" : "" }}>
                    <label class="custom-control-label" for="store_status_2">เลิกใช้งาน</label>
                </div>
            </div>
            <div class="form-group mt-5 mb-5">
                <h5>การยืนยันร้านค้า <Span style="color: red">*</Span></h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="confirm" id="exampleRadios1"
                        value=1 {{ ($store->confirm=="1")? "checked" : "" }}>
                    <label class="form-check-label" for="exampleRadios1">
                        ยืนยัน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="confirm" id="exampleRadios2"
                        value=2 {{ ($store->confirm=="2")? "checked" : "" }}>
                    <label class="form-check-label" for="exampleRadios2">
                        ปฏิเสธ
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="confirm" id="exampleRadios3"
                        value=0 {{ ($store->confirm=="0")? "checked" : "" }} disabled>
                    <label class="form-check-label" for="exampleRadios3">
                        รอดำเนินการ
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" checked class="custom-control-input" id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">เพิ่มใบกำกับภาษี</label>
                    </div>
                    <!-- <button type="button" class="btn btn-outline-info" onclick="archiveFunction();">เพิ่มใบกำกับภาษี</button> -->
                </div>
            </div>
            <div id="result">
                <div class="row mt-3">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="formGroupExampleInput">ชื่อผู้เสียภาษี</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="store_tax_name"
                                value="{{ $store->store_tax_name }}">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">หมายเลขผู้เสียภาษี</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" name="store_tax_id"
                                value="{{ $store->store_tax_id }}">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ที่อยู่ในใบกำกับภาษี</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="store_tax_contact"
                                rows="3"
                                value="{{ $store->store_tax_contact }}">{{ $store->store_tax_contact }}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="show-image">
                <img src="{!! Storage::disk('do_spaces')->url('stores/' . $store->store_image) !!}" id="edit-image-store" width="90%" height="40%">
            </div>
            <div class="form-group">
                <label for="storeimage">รูปร้านค้า</label>
                <input type="file" class="form-control-file" onchange="readURL(this);" id="storeimage" name="storeimage">
            </div>
            <div class="show-image">
                <img src="{!! Storage::disk('do_spaces')->url('stores/' . $store->store_lineid_image) !!}" id="edit-image-line" width="90%" height="40%">
            </div>
            <div class="form-group">
                <label for="storeimageline">รูปไลน์ไอดี</label>
                <input type="file" class="form-control-file" onchange="readURLLine(this);" id="storeimageline" name="storeimageline">
            </div>
            <div class="show-image">
                <img src="{!! Storage::disk('do_spaces')->url('stores/' . $store->store_tax_image) !!}" id="edit-image-tax" width="90%" height="40%">
            </div>
            <div class="form-group">
                <label for="storeimagetax">รูปใบกำกับภาษี</label>
                <input type="file" class="form-control-file" onchange="readURLTax(this);" id="storeimagetax" name="storeimagetax">
            </div>

            <button type="submit" class="btn btn-primary mt-5">Submit</button>
        </form>

    </div>
</section>
@endsection
@section('footerscript')
<script>
    function getLocation() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                $("#store_lat").val(position.coords.latitude);
                $("#store_lng").val(position.coords.longitude);
                // 
            });
        } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }
    }
    $('#store_tel').on('input', function () {
        var store_tel = $('#store_tel').val().replace(/,/g, "").replace(/%/g, "");
        $('#store_tel').val(store_tel.toString().replace(/[^0-9]/g, ""));
    });

    $(function () {
        $('#customSwitch').change(function () {
            if ($(this).prop('checked')) {
                document.getElementById("result").style.display = "block";
            } else {
                document.getElementById("result").style.display = "none";
            }
        })
    });

</script>
@endsection
