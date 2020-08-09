<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="row mt-5">
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
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ชื่อร้าน</h2></div>
                            <div class="col-4"><h2>{{$store->store_name}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>เบอร์ติดต่อ</h2></div>
                            <div class="col-4">
                                <a href="tel:{{$store->store_tel}}">
                                <h2>{{$store->store_tel}}</h2></a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>สถานนะร้านค้า</h2></div>
                            <div class="col-4"><h2>{{$store->store_status ? "ปกติ" : "ปิดกิจการ"}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ประเภทสินค้า</h2></div>
                            <div class="col-4"><h2>{{$store->store_contact}}</h2></div>
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
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ชื่อโปรโมชัน</h2></div>
                            <div class="col-4"><h2>{{$item->promotion_name}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>รายละเอียดโปรโมชัน</h2></div>
                            <div class="col-4"><h2>{{$item->promotion_detail}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ราคา</h2></div>
                            <div class="col-4"><h2>{{$item->promotion_price}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ประเภทสินค้า</h2></div>
                            <div class="col-4"><h2>{{$item->type->type_name}}</h2></div>
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
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>หมายเลขผู้เสียภาษี</h2></div>
                            <div class="col-4"><h2>{{$store->store_tax_id}}</h2></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ชื่อผู้เสียภาษี</h2></div>
                            <div class="col-4">
                                <h2>{{$store->store_tax_name}}</h2></a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4"><h2>ที่อยู่ผู้เสียภาษี</h2></div>
                            <div class="col-4"><h2>store_tax_contact</h2></div>
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




<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>