@extends('layouts.frontend')

@section('content')
<span class="align-middle">    
    <div class="jumbotron mt-5">
        <h1 class="display-4">404 !</h1>
        <p class="lead">ขออภัย ไม่พบหน้าที่ท่านต่องการ</p>
        <hr class="my-4">
        <a class="btn btn-success btn-lg" href="{{ route('welcome') }}" role="button">กลับสู่หน้าแรก</a>
        <a class="btn btn-success btn-lg" href="{{ route('welcome') }}" role="button">กลับสู่หน้าแรก</a>
    </div>
</span>
@endsection

