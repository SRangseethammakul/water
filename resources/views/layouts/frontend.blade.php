<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
  
  <meta name="description" content="เราให้บริการจัดส่งน้ำดื่มเนสท์เล่ เพียวไลฟ์ และ น้ำแร่ธรรมชาติ มิเนเร่ ใน หัวหิน ปราณบุรี จังหวัดประจวบคีรีขันธ์">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/water.png') }}">

  <title> {{ __('WATER')}} </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap core CSS -->
  <link href=" {{ asset('css/app.css') }}" rel = "stylesheet">

  <!-- Custom styles for this template -->
  <link href=" {{ asset('css/theme.css') }}" rel = "stylesheet">

  {{-- This page and all of the switch buttons shown are running on Bootstrap 4.3 --}}
  <link rel="stylesheet" href="css/bootstrap4-toggle-3.6.1/bootstrap4-toggle.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-176282105-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176282105-1');
</script>

</head>

<body>

  <!-- Navigation -->
  <div id="app">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">WATER SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('welcome') }}">หน้าแรก
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">ติดต่อเรา</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('welcome') }}">เลือกดูสินค้า</a>
            </li>
            @auth
            <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">
                ตะกร้าสินค้า
                <span class="badge badge-success">
                    {{  App\Cart::where('user_id',auth()->user()->id)->sum('qty')  }}
                </span>
            </a>
            </li>
            @endauth
            {{-- <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li> --}}
             <!-- Authentication Links -->
             @guest
             <li class="nav-item ">
                 <a class="nav-link" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">เข้าสู่ระบบ</a>
             </li>
             @if (Route::has('register'))
             <li class="nav-item ">
                 <a class="nav-link" href="{{ route('register') }}">ลงทะเบียน</a>
             </li>
             @endif @else
             <li class="nav-item dropdown">
                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false" v-pre>
                      ยินดีต้อนรับคุณ {{ Auth::user()->name }} <span class="caret"></span>
                  </a>
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @role('Staff|Admin')
                      <a class="dropdown-item bg-primary" href="{{ route('home') }}">
                        Dashboard
                      </a>
                      <a class="dropdown-item bg-warning" href="../store/search">
                        ระบบค้นหาร้านค้า
                      </a>
                    @endrole
                    <a class="dropdown-item bg-success" href="{{ route('profile.index') }}">
                      ที่อยู่ในการจัดส่ง
                    </a>
                    <a class="dropdown-item bg-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      ออกจากระบบ
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                 </div>
             </li>
             @endguest
          </ul>
        </div>
      </div>
    </nav>

      <!-- Page Content -->
      <div class="container">
          @yield('content')
      </div>
      <!-- /.container -->

    @include('partials.footer')
    @include('partials.login')



  </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ติดต่อเรา</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="firstname" class="col-form-label">ชื่อ:</label>
            <input type="text" class="form-control" name="firstname" id="firstname" required>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-form-label">นามสกุล:</label>
            <input type="text" class="form-control" id="lastname" required>
          </div>
          <div class="form-group">
            <label for="profile_tel" class="col-form-label">เบอร์โทรศัพท์:</label>
            <input type="tel" class="form-control" id="profile_tel" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">หัวข้อที่ต้องการติดต่อ</label>
            <select class="form-control" id="exampleFormControlSelect1" required>
              <option value="สอบถามโปรโมชันเพิ่มเติม">สอบถามโปรโมชันเพิ่มเติม</option>
              <option value="สอบถามสินค้าเพิ่มเติม">สอบถามสินค้าเพิ่มเติม</option>
              <option value="สอบถามราคาสินค้าเพิ่มเติม">สอบถามราคาสินค้าเพิ่มเติม</option>
              <option value="สอบถามการส่งสินค้า">สอบถามการส่งสินค้า</option>
              <option value="สนใจร่วมงานกับเรา">สนใจร่วมงานกับเรา</option>
              <option value="อื่นๆ">อื่น ๆ</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>

  {{-- This page and all of the switch buttons shown are running on Bootstrap 4.3 --}}
  <script src="js/bootstrap4-toggle-3.6.1/bootstrap4-toggle.js"></script>


  <script>
    $('#profile_tel').on('input', function() {
        var profile_tel = $('#profile_tel').val().replace(/,/g, "").replace(/%/g, "");
        $('#profile_tel').val(profile_tel.toString().replace(/[^0-9]/g, ""));
    });
    </script>
  @yield('footerscript')

</body>

</html>
