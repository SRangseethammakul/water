@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">แก้ไขประเภทสินค้า</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <section class="content" id="app">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_tel">ชื่อ</label>
                        <input type="text" class="form-control" id="store_tel" name="store_tel" maxlength="10"  value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_line">Email</label>
                        <input type="text" class="form-control" id="store_line" name="store_line" value="{{ $user->email }}" readonly>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('user.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role select</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                    <option>{{$user_role->name}}</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
