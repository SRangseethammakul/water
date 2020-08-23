@extends('layouts.frontend')

@section('content')
    <section class="content" id="app">
        <div class="container mt-5">
            <form method="post" action="#" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="profile_tel" name="profile_tel" required placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profile_tel_2">หมายเลขโทรศัพท์ 2</label>
                            <input type="text" class="form-control" id="profile_tel_2" name="profile_tel_2"  placeholder="เบอร์โทรศัพท์สำรอง">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="province-select">จังหวัด</label>
                            <select class="js-example-basic-single" id="province-select" class="form-control" style="width: 100%">
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
                            <select class="js-example-basic-single" id="district-select" class="form-control" style="width: 100%">
                                <option selected>เลือกอำเภอ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="district-select">ตำบล</label>
                            <select class="js-example-basic-single" id="sub-district-select" class="form-control" style="width: 100%">
                                <option selected>เลือกตำบล</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                    var $group = $('#sub-district-select').html('<option value="">เลือกอำเภอ</option>');
                    if (response.status == 1) {
                        if (response.data.length > 0) {
                            $.each(response.data, function (key, val) {
                                $group.append('<option value="' + val.sub_district_code + '">' + val.sub_district_name + '</option>')
                                
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

