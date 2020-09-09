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

  <!-- Bootstrap core CSS -->
  <link href=" {{ asset('css/app.css') }}" rel = "stylesheet">

  <!-- Custom styles for this template -->
  <link href=" {{ asset('css/theme.css') }}" rel = "stylesheet">

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
              <a class="nav-link" href="{{ route('welcome') }}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
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
                 <a class="nav-link" href="{{ route('login') }}">เข้าระบบ</a>
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
                      <a class="dropdown-item bg-success" href="../store/search">
                        ระบบค้นหาร้านค้า
                      </a>
                    @endrole
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


  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>

  @yield('footerscript')
</body>

</html>
