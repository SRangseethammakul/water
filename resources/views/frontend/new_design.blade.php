@extends('layouts.frontend')
@section('content')
  <!-- Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper" id="result">

    </div>

    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>

    <!-- Add Arrows -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>

@endsection
@section('footerscript')
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'flip',
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    var _xhr;
    function startSearch(){
        $.ajax({
            url: '/api/show/banners',
            method: 'GET',
            success: function (response) {
                if (response.status == 1) {
                    $.each(response.banners, function(index,item) {
                        console.log(item.img);
                        var html_q =
                        `
                        <div class="swiper-slide" style="background-image:url(`+item.img+`)"></div>
                         `
                        $("#result").append(html_q);
                    });
                }   
            }
        });
    }

    $(document).ready(function(){
      startSearch();
    });
</script>
@endsection
