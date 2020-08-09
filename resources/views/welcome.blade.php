<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

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



<script src="{{ asset('js/app.js') }}"></script>
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
                        $store_promotion = 0;
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
        console.log(num.length > 0, num.length);
        if(num.length > 0){
            startSearch();
        }
    });
</script>
</body>

</html>