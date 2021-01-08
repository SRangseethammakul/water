@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col align-self-center">
            <img src="{{ asset('images/water.png') }}" width="10%" style=" display: block;margin-left: auto;margin-right: auto">
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <input class="form-control form-control-lg" id="search" type="text" placeholder="ชื่อร้าน เบอร์โทร เจ้าของร้าน">
    </div>
    <div id="result"></div>
</div>
@endsection
@section('footerscript')
<script>
    var _xhr;
    function startSearch(){
        console.log("sdfg");
        $.ajax({
            url: '/api/getorder',
            method: 'GET',
            success: function (response) {
                if (response.status == 1) {
                    $.each(response.data, function(index,item) {
                        var html_q =
                        `
                        <div class="jumbotron">
                            <h1 class="display-4"> status :  `+ item.order_status + `</h1>
                            <p class="lead">วันจัดส่ง `+ item.order_delivery + `</p>
                            <p class="lead">ราคา `+ item.sum_total + `</p>
                            <a class="btn btn-info btn-lg" href="detail/`+item.id+`" role="button">ดูข้อมูลเพิ่มเติม</a>
                        </div>
                         `
                        $("#result").append(html_q);
                    });
                }   
            }
        });
    }
    $(document).ready(function () {
        startSearch();
    });
</script>
@endsection