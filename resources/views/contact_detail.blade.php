@extends('layouts.frontend')

@section('content')
<div class="container">
  <div class="row mt-5" style="margin-right: 0px">
    <div class="col align-self-center">
        <img src="{{ asset('images/water.png') }}" width="10%" style=" display: block;margin-left: auto;margin-right: auto">
    </div>
</div>

<div class="container mt-5">
    <h1 class="display-4">{{$store->store_name}}</h1>

    <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                รายละเอียดร้านค้า
              </button>
            </h2>
          </div>
      
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 offset-md-2"><h2>ชื่อร้าน</h2></div>
                        <div class="col-md-4 ml-auto"><h2>{{$store->store_name}}</h2></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 offset-md-2"><h2>เบอร์ติดต่อ</h2></div>
                        <div class="col-md-4 ml-auto">
                            <a href="tel:{{$store->store_tel}}">
                            <h2>{{$store->store_tel}}</h2></a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 offset-md-2"><h2>สถานนะร้านค้า</h2></div>
                        <div class="col-md-4 ml-auto"><h2>{{$store->store_status ? "ปกติ" : "ปิดกิจการ"}}</h2></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 offset-md-2"><h2>ประเภทสินค้า</h2></div>
                        <div class="col-md-4 ml-auto"><h2>{{$store->store_contact}}</h2></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                โปรโมชันร้านค้า
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            @foreach ($promotions as $item)
                <div class="card-body">
                    <div class="container">
                      <div class="row">
                          <div class="col-md-4 offset-md-2"><h2>ชื่อโปรโมชัน</h2></div>
                          <div class="col-md-4 ml-auto"><h2>{{$item->promotion_name}}</h2></div>
                      </div>   
                      <hr>
                      <div class="row">
                          <div class="col-md-4 offset-md-2"><h2>รายละเอียดโปรโมชัน</h2></div>
                          <div class="col-md-4 ml-auto"><h2>{{$item->promotion_detail}}</h2></div>
                      </div>
                      <hr>
                      <div class="row justify-content-center">
                          <div class="col-md-4 offset-md-2"><h2>ราคา</h2></div>
                          <div class="col-md-4 ml-auto"><h2>{{$item->promotion_price}}</h2></div>
                      </div>
                      <hr>
                      <div class="row justify-content-center">
                          <div class="col-md-4 offset-md-2"><h2>ประเภทสินค้า</h2></div>
                          <div class="col-md-4 ml-auto"><h2>{{$item->product->product_name}}</h2></div>
                      </div>
                    </div>
                </div>
                <hr>
            @endforeach    
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                ข้อมูลใบกำกับภาษี
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 offset-md-2"><h2>หมายเลขผู้เสียภาษี</h2></div>
                        <div class="col-md-4 ml-auto"><h2>{{$store->store_tax_id}}</h2></div>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-4 offset-md-2"><h2>ชื่อผู้เสียภาษี</h2></div>
                        <div class="col-md-4 ml-auto">
                            <h2>{{$store->store_tax_name}}</h2></a>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-4 offset-md-2"><h2>ที่อยู่ผู้เสียภาษี</h2></div>
                        <div class="col-md-4 ml-auto"><h2>{{$store->store_tax_contact}}</h2></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                การนำทาง
              </button>
            </h2>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 offset-md-2">
                          <a href="https://maps.google.com/?daddr={{$store->store_lat}},{{$store->store_lng}}" target="_blank">
                            <img src="{{ asset('images/map.png') }}" width="40%" style=" display: block;margin-left: auto;margin-right: auto">
                          <a>
                        </div>
                        <div class="col-md-4 ml-auto">
                          <a href="https://maps.google.com/?daddr={{$store->store_lat}},{{$store->store_lng}}" target="_blank">
                            <h2>
                            นำทางด้วย Google Map
                            </h2>
                          <a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <a href="/">
        <button type="button" class="btn btn-primary btn-lg btn-block">กลับไปค้นหาร้านค้า</button>
    </a>
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
