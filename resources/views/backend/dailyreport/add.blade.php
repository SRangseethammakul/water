@extends('layouts.backend')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">เพิ่มรายงานประจำวัน</h1>
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
        <form method="post" action="{{ route('dailyreport.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group  mt-5">
                @foreach ($types as $item)
                <div class="form-group row">
                    <label for="colFormLabelLg"
                        class="col-sm-2 col-form-label col-form-label-lg">{{$item->type_name}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="price_{{ $item->id }}" class="form-control form-control-lg" id="colFormLabelLg"
                            placeholder="ราคาที่ขายได้ในวันนี้" required>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
@endsection
@section('footerscript')
<script>
    $('#product_price').on('input', function () {
        var product_price = $('#product_price').val().replace(/,/g, "").replace(/%/g, "");
        $('#product_price').val(product_price.toString().replace(/[^0-9]/g, ""));
    });

</script>
@endsection
