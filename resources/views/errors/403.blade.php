@extends('layouts.frontend')

@section('content')
<span class="align-middle">    
    <div class="jumbotron mt-5">
        <h1 class="display-4">403 !</h1>
        <p class="lead">ขออภัย บัญชีของท่านถูกระงับการใช้งานชั่วคราว</p>
        <hr class="my-4">
        <a class="btn btn-success btn-lg" href="{{ route('welcome') }}" role="button">กลับสู่หน้าแรก</a>
    </div>
</span>
@endsection

