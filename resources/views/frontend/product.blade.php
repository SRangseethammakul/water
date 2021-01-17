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

        <div id="carouselExampleControls" class="carousel slide my-4" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($banners as $key => $item)
            <div class="carousel-item{{ ($key) ? '' : ' active' }}">
              <img class="d-block img-fluid"  src="{{ Storage::disk('do_spaces')->temporaryUrl('banners/'. $item->banner_image, now()->addMinutes(15) ) }}">
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
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
  startSearch();
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
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-outline-danger" onclick="stepDownFunction(${item.id})" type="button" id="button-addon${item.id}"><i class="fa fa-minus"></i></button>
                                    <input type="number" min="1" id="myNumber-${item.id}" class="form-control" value=1 inputmode="numeric">
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
    @if(session('day'))
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script>
        Swal.fire(
            '{{ session('feedback')}}', //
            'เราจะทำการติดต่อภายในวันที่ {{ session('day')}}',
            'success'
        )
    </script>
@endif
@endsection

