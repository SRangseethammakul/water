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
        var search = $('#search').val();
        _xhr = $.ajax({
            url: '/search',
            method: 'GET',
            data: {
                search : search
            },
            success: function (response) {
                if (response.status == 1) {
                    $.each(response.data, function(index,item) {
                        var html_q =
                        `
                        <div class="jumbotron">
                            <h1 class="display-4">`+ item.store_name + `</h1>
                            <p class="lead">ติดต่อคุณ `+ item.store_contact + `</p>
                            <p class="lead">เบอร์ติดต่อ `+ item.store_tel + `</p>
                            <a class="btn btn-info btn-lg" href="detail/`+item.id+`" role="button">ดูข้อมูลเพิ่มเติม</a>
                        </div>
                         `
                        $("#result").append(html_q);
                    });
                }   
            }
        });
    }
    $('#search').on('keyup', function() {
        _xhr && _xhr.abort();
        $('#result').html('');
        var num = $('#search').val();
        if(num.length > 0){
            startSearch();
        }
    });
</script>
@endsection
