@extends('layouts.frontend')

@section('content')

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">ประเภทสินค้า</h1>
        <div class="list-group">
          <a onclick="productall()" class="list-group-item" style="cursor: pointer;">แสดงสินค้าทั้งหมด</a>
          @foreach ($category as $c)
            <a onclick="myFunction('{{ $c->id }}')" class="list-group-item" style="cursor: pointer;">{{ $c->type_name }}</a>
          @endforeach
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
          <!-- Swiper -->
        <div class="swiper-container">
          <div class="swiper-wrapper">
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination swiper-pagination-white"></div>
          <!-- Add Arrows -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>

        <!-- /.row -->
        <div id="result" class="row mt-5">
            
        </div>

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection
@section('footerscript')
<script type="text/javascript">
  var type;
  var _xhr;
  var _xhrBanner;
  function startSearch(){
      _xhr = $.ajax({
          url: '/search_product',
          method: 'GET',
          data: {
              search : type
          },
          success: function (response) {
              if (response.status == 1) {
               if(response.data.length > 0){
                $.each(response.data, function(index,item) {
                      var html_q =
                      `<div class="col-lg-4 col-md-6 mb-4">
                          <div class="card h-100">
                            <a ><img class="card-img-top" height="250px" src="https://water-systems.sgp1.digitaloceanspaces.com/products/`+ item.product_image +`" alt=""></a>
                            <div class="card-body">
                              <h4 class="card-title">
                                <a >`+ item.product_name +`</a>
                              </h4>
                              <br>
                              <h5>ราคา : `+ item.product_price +`</h5>
                              <p class="card-text">`+ item.product_detail +`</p>
                            </div>
                            <div class="card-footer">
                              <div class="container">
                                <div class="d-flex justify-content-around mb-2">
                                    <button class="btn btn-outline-danger mr-2" onclick="stepDownFunction(${item.id})" type="button" id="button-addon${item.id}"><i class="fa fa-minus"></i></button>
                                    <input type="number" min="1" id="myNumber-${item.id}" class="form-control mr-2" value=1 inputmode="numeric" style="text-align:right;"/>
                                    <button class="btn btn-outline-success" onclick="stepUpFunction(${item.id})" type="button" id="button-deleteon${item.id}"><i class="fa fa-plus"></i></button>
                                </div>
                              </div>
                              <div class="row">
                                <a href="cart/${item.id}" id="cart-${item.id}" onclick="return triggerMe(${item.id});" class="btn btn-outline-info btn-lg btn-block"> หยิบความสดชื่น </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        `
                      $("#result").append(html_q);
                });
               }
               else{
                var html_q =
                      `
                      <div class="container">
                        <div class="row">
                          <div class="col align-self-center">
                            <div class="jumbotron">
                              <h1 class="display-4">ขออภัยไม่มีสินค้าในประเภทที่ท่านเลือก</h1>
                              <hr class="my-4">
                              <p>เรายังมีสินค้าให้เลือกอีกมากมาย</p>
                              <a class="btn btn-primary btn-lg" onclick="productall()"  role="button">ดูสินค้าทั้งหมด</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      `
                      $("#result").append(html_q);        
                } 
              }  
          }

      });
  }

  function myFunction(name) {
    type = name;
    _xhr && _xhr.abort();
    $('#result').html('');
    startSearch();
  }
  function triggerMe(id)
  {
    let valId = document.getElementById(`myNumber-${id}`).value;
    let cartId = document.getElementById(`cart-${id}`);
    $(cartId).attr("href", `${cartId.href}?val=${valId}`);
  }
  function productall() {
    type = '';
    _xhr && _xhr.abort();
    $('#result').html('');
    startSearch();
  }
  function stepUpFunction(id) {
    document.getElementById(`myNumber-${id}`).stepUp(1);
  }
  function stepDownFunction(id) {
    document.getElementById(`myNumber-${id}`).stepDown(1);
  }
  function startBanner(){
    _xhrBanner = $.ajax({
          url: '{{ route('bannerAPI')}}',
          method: 'GET',
          success: function (response) {
              if (response.status == 1) {
                $.each(response.banners, function(index,item) {
                  $(".swiper-wrapper").append(
                        `
                        <div class="swiper-slide">
                        <img class="img-fluid" src="${item.img}">
                        </div>
                        `
                      );
                });
                swiper.update(true);
              }  
          }

      });
  }
  var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    startSearch();
    startBanner();
</script>

    @if(session('feedback'))
        <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
        <script>
            Swal.fire(
                '{{ session('feedback')}}', //
                '',
                '{{ session('type')}}'
            )
        </script>
    @endif
    @if(session('day'))
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script>
        Swal.fire(
            '{{ session('feedback')}}', //
            'เราจะทำการติดต่อภายในวันที่ {{ session('day')}}',
            '{{ session('type')}}'
        )
    </script>
  @endif
@endsection

