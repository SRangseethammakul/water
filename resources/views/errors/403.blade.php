@extends('layouts.frontend')

@section('content')
<span class="align-middle">    
    <div class="jumbotron mt-5">
        <h1 class="display-4">403 !</h1>
        <p class="lead">ขออภัย บัญชีของท่านถูกระงับการใช้งานชั่วคราว</p>
        <hr class="my-4">
        <a class="btn btn-success btn-lg" href="{{ route('welcome') }}" role="button">กลับสู่หน้าแรก</a>
        <button type="button" class="btn btn-primary" data-toggle="modal403" data-target="#exampleModal403">
            ติดต่อเรา
        </button>
    </div>
</span>
<!-- Modal -->
<div class="modal fade" id="exampleModal403" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ติดต่อเรา</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h1 class="display-4">0817362947</h1>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection

