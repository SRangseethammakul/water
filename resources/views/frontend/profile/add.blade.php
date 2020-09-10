@extends('layouts.frontend')

@section('content')
    <section class="content" id="app">
        <div class="container mt-5">
            <form method="post" action="{{ route('profile.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profile_name">ชื่อ <Span style="color: red">*</Span></label>
                            <input type="text" class="form-control" id="profile_name" name="profile_name" required placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profile_lastname">นามสกุล <Span style="color: red">*</Span></label>
                            <input type="text" class="form-control" id="profile_lastname" name="profile_lastname" required placeholder="นามสกุล">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profile_tel">หมายเลขโทรศัพท์ <Span style="color: red">*</Span></label>
                            <input type="tel" class="form-control" id="profile_tel" name="profile_tel" required maxlength="10" placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profile_tel_2">หมายเลขโทรศัพท์ (สำรอง)</label>
                            <input type="tel" class="form-control" id="profile_tel_2" name="profile_tel_2" maxlength="10" placeholder="เบอร์โทรศัพท์สำรอง">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_delivery">ที่อยู่ในการจัดส่ง</label>
                    <textarea class="form-control" id="address_delivery" name="address_delivery" rows="3" required></textarea>
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
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="district-select">อำเภอ</label>
                            <select class="js-example-basic-single" id="district-select" name="amphure" class="form-control" style="width: 100%">
                                <option selected>เลือกอำเภอ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="sub-district-select">ตำบล</label>
                            <select class="js-example-basic-single" id="sub-district-select" name="sub_district" class="form-control" style="width: 100%">
                                <option selected>เลือกตำบล</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="district-select">รหัสไปรษณีย์</label>
                            <input type="text" id="zipcode" class="form-control" name="zipcode" placeholder="รหัสไปรษณีย์">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="profile_lat" name="profile_lat" placeholder="Latitude">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="profile_lng" name="profile_lng" placeholder="Longtude">
                        </div>
                    </div>
                    <div class="col-sm">
                        <button onclick="getLocation()" type="button" class="btn btn-success btn-block" id="get_ltlng" data-toggle="button" aria-pressed="false">
                            ค้นหาพิกัดคุณ
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block mt-5">เพิ่มที่อยู่ในการจัดส่ง</button>
            </form>
        </div>
    </section>




@endsection
@section('footerscript')

<script type="text/javascript">
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
        function getLocation() {
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    $("#profile_lat").val(position.coords.latitude);
                    $("#profile_lng").val(position.coords.longitude);
                    // 
                });
            } else {
                alert("Sorry, your browser does not support HTML5 geolocation.");
            }
        }
        $('#profile_tel').on('input', function() {
            var profile_tel = $('#profile_tel').val().replace(/,/g, "").replace(/%/g, "");
            $('#profile_tel').val(profile_tel.toString().replace(/[^0-9]/g, ""));
        });
        $('#profile_tel_2').on('input', function() {
            var profile_tel_2 = $('#profile_tel_2').val().replace(/,/g, "").replace(/%/g, "");
            $('#profile_tel_2').val(profile_tel_2.toString().replace(/[^0-9]/g, ""));
        });
        $('#province-select').change(function() {
            var province_id = $(this).val();
            console.log(province_id);
            $.ajax({
                url: '/ajax/getamphuresbyprovince/' + province_id,
                method: 'GET',
                success: function (response) {
                    var $group = $('#district-select').html('<option value="">เลือกอำเภอ</option>');
                    if (response.status == 1) {
                        if (response.data.length > 0) {
                            $.each(response.data, function (key, val) {
                                $group.append('<option value="' + val.district_code + '">' + val.district_name + '</option>')
                                
                            });
                            $('#district-select').append($group);
                        } else {
                            $('#district-select').prop('disabled', true);
                        }
                    } else {
                        $('#district-select').prop('disabled', true);
                    }
                }
            });
        });
        $('#district-select').change(function() {
            var province_id = $(this).val();
            console.log(province_id);
            $.ajax({
                url: '/ajax/getsubdistrictbydistrict/' + province_id,
                method: 'GET',
                success: function (response) {
                    var $group = $('#sub-district-select').html('<option value="">เลือกตำบล</option>');
                    if (response.status == 1) {
                        if (response.data.length > 0) {
                            $.each(response.data, function (key, val) {
                                $group.append('<option value="' + val.sub_district_id + '">' + val.sub_district_name + '</option>')  
                            });
                            $('#sub-district-select').append($group);
                        } else {
                            $('#sub-district-select').prop('disabled', true);
                        }
                    } else {
                        $('#sub-district-select').prop('disabled', true);
                    }
                }
            });
        });
        $('#sub-district-select').change(function() {
            var province_id = $(this).val();
            console.log(province_id);
            $.ajax({
                url: '/ajax/getzipcodebysubdistrict/' + province_id,
                method: 'GET',
                success: function (response) {
                    var $group = $('#zipcode').html('<input type="text" class="form-control" name="zipcode" placeholder="กอกดอ">');
                    if (response.status == 1) {

                        if (response.data.length > 0) {
                            $.each(response.data, function (key, val) {
                                $("#zipcode").val(val.zip_code); 
                                $group.append('<input type="text" class="form-control" name="zipcode" value='+ val.zip_code +'>')
                            });
                        } else {
                            $('#zipcode').prop('disabled', true);
                        }
                    } else {
                        $('#zipcode').prop('disabled', true);
                    }
                }
            });
        });
</script>

@if(session('feedback'))
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    
    <script>
        Swal.fire(
            '{{ session('feedback')}}', //
            'You clicked the button!',
            'success'
        )
    </script>
@endif
@endsection

