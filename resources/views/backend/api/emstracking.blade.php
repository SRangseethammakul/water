@extends('layouts.backend')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">ค้นหา EMS</h1>
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
        <div class="form-group mt-5">
            <label for="ems_tracking">ค้นหาพัสดุไปรษณีย์ไทย</label>
            <input type="text" class="form-control" id="ems_tracking">
        </div>
        <p id="text">Caps lock is ON.</p>
        <button type="submit" onclick="tracking()" class="btn btn-primary">ค้นหาพัสดุ</button>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ผลการค้นหาพัสดุ</h5>
                {{-- {!! app('captcha')->display($attributes = [], $options = ['lang'=> 'th']) !!} --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center" >
    <div class="spinner-border text-danger" id="loader" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection
@section('footerscript')
<script type="text/javascript">
    var _xhr;
    document.getElementById("text").style.display = "none";
    $("#loader").hide();
    function startSearch() {
        var ems_tracking = $('#ems_tracking').val();
        console.log(ems_tracking);
        _xhr = $.ajax({
            url: 'emstracking/search',
            method: 'GET',
            data: {
                search: ems_tracking
            },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (response) {
                if (response.status == 1) {
                    $.each(response.data, function (index, item) {
                        let html_q =
                            `
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container-fluid mt-2">
                                    <div class="row">
                                        <div class="col-md-4">หมายเลข</div>
                                        <div class="col-md-4 ml-auto">` + item.barcode + `</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">สถานะพัสดุ</div>
                                        <div class="col-md-4 ml-auto">` + item.status_description + `</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">ชื่อผู้รับ</div>
                                        <div class="col-md-4 ml-auto">` + item.receiver_name + `</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">วันที่จัดส่ง</div>
                                        <div class="col-md-4 ml-auto">` + item.status_date + `</div>
                                    </div>
                                </div>
                            </div>
                         `
                        $("#result").append(html_q);
                    });
                    $('#exampleModal').modal('show');
                } else {
                    let html_q =
                        `
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">สถานะ</div>
                                <div class="col-md-4 ml-auto">ไม่พบข้อมูล</div>
                            </div>
                        </div>
                         `
                    $("#result").append(html_q);
                    $('#exampleModal').modal('show');
                }
                $("#loader").hide();
            }
        });
    }

    $('#ems_tracking').on('input', function () {
        var ems_tracking = $('#ems_tracking').val();
        $('#ems_tracking').val(ems_tracking.toString().replace(/\/\//g, "").replace(/ /g, "").replace(
            /[^0-9A-Z-_\/]/g, ""));
    });

    function tracking() {
        _xhr && _xhr.abort();
        $('#result').html('');
        var num = $('#ems_tracking').val();
        if (num.length > 0) {
            startSearch();
        }
    }

    var input = document.getElementById("ems_tracking");
    var text = document.getElementById("text");
    input.addEventListener("keyup", function (event) {

        if (event.getModifierState("CapsLock")) {
            text.style.display = "block";
        } else {
            text.style.display = "none"
        }
    });

</script>
@endsection
