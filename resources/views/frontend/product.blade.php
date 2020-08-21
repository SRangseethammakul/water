@extends('layouts.frontend')

@section('content')

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">ประเภทสินค้า</h1>
        <div class="list-group">
          @foreach ($category as $c)
            <a href="#" onclick="myFunction('{{ $c->id }}')" class="list-group-item">{{ $c->type_name }}</a>
          @endforeach
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>


        <!-- /.row -->
        <div class="row">
        <div id="result"></div>
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
  startSearch()
  function startSearch(){
    console.log(type);
      _xhr = $.ajax({
          url: '/search_product',
          method: 'GET',
          data: {
              search : type
          },
          success: function (response) {
              if (response.status == 1) {
                  $.each(response.data, function(index,item) {
                      var html_q =
                      `
                      
                        <div class="col-lg-4 col-md-6 mb-4">
                          <div class="card h-100">
                            <a href="#"><img class="card-img-top" height="250px" src="https://water-systems.sgp1.digitaloceanspaces.com/products/`+ item.product_image +`" alt=""></a>
                            <div class="card-body">
                              <h4 class="card-title">
                                <a href="#">`+ item.product_name +`</a>
                                </h4>
                                <br>
                                <h5>ราคา : `+ item.product_price +`</h5>
                                <p class="card-text">`+ item.product_detail +`</p>
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
                        <h2>ขออภัยไม่พบสินค้า</h2>
                      `
                      $("#result").append(html_q);        
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

