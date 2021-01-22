@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่มประเภทบทบาท</h1>
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
            <form method="post" action="{{ route('role.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5">
                    <label for="role_name">ชื่อบทบาท</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" required>
                </div>
                @foreach($permissions as $permission)
                <div class="row">
                    <div class="col-sm">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="check_list[]" type="checkbox"
                                id="inlineCheckbox{{ $permission->id }}" value="{{ $permission->id }}"
                                style="width: 20px;height: 20px;">
                            <label class="form-check-label ml-5"
                                for="inlineCheckbox{{ $permission->id }}">{{$permission->name }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-5">Submit</button>
            </form>
        </div>
    </section>
@endsection
