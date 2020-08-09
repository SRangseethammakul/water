@extends('layouts.backend')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">เพิ่มร้านค้า</h1>
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
            <form method="post" action="{{ route('store.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_name">ชื่อร้านค้า</label>
                        <input type="text" class="form-control" id="store_name" name="store_name" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_contact">ชื่อลูกค้า</label>
                        <input type="text" class="form-control" id="store_contact" name="store_contact" required>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="store_tel">เบอร์ร้านค้า</label>
                        <input type="text" class="form-control" id="store_tel" name="store_tel" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">ที่อยู่ร้านค้า</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="store_address" rows="3"></textarea>
                    </div>
                </div>
            </div>

            @foreach($promotions as $infraction)
                <div class="row">
                    <div class="col-sm">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="check_list[]" type="checkbox" id="inlineCheckbox{{ $infraction->id }}" value="{{ $infraction->id }}" style="width: 20px;height: 20px;">
                            <label class="form-check-label ml-5" for="inlineCheckbox{{ $infraction->id }}">{{$infraction->promotion_name }} ราคา : {{$infraction->promotion_price }}</label>
                        </div>
                    </div>
                </div>
            @endforeach


                <div class="form-group">
                    <label for="store_detail">รายละเอียด ร้านค้า</label>
                    <textarea class="form-control" id="store_detail" name="store_detail" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="store_status_1" value="1" name="store_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="store_status_1">ใช้งาน</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="store_status_2" value="0" name="store_status" class="custom-control-input" required>
                        <label class="custom-control-label" for="store_status_2">เลิกใช้งาน</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch">
                            <label class="custom-control-label" for="customSwitch">เพิ่มใบกำกับภาษี</label>
                        </div>
                    <!-- <button type="button" class="btn btn-outline-info" onclick="archiveFunction();">เพิ่มใบกำกับภาษี</button> -->
                    </div>
                </div>
                <div id="result">
                    <div class="row mt-3">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="formGroupExampleInput">ชื่อผู้เสียภาษี</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="store_tax_name" placeholder="ชื่อผู้เสียภาษี">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">หมายเลขผู้เสียภาษี</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="store_tax_id" placeholder="หมายเลขผู้เสียภาษี">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">ที่อยู่ในใบกำกับภาษี</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="store_tax_contact" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Submit</button>
            </form>
            
        </div>
    </section>
@endsection
@section('footerscript')
    <script>
        document.getElementById("result").style.display = "none";
        $('#store_tel').on('input', function() {
            var store_tel = $('#store_tel').val().replace(/,/g, "").replace(/%/g, "");
            $('#store_tel').val(store_tel.toString().replace(/[^0-9]/g, ""));
        });
      $(function() {
            $('#customSwitch').change(function() {
                if($(this).prop('checked')){
                    document.getElementById("result").style.display = "block";
                }
                else{
                    document.getElementById("result").style.display = "none";
                }
            })
        });
    </script>
@endsection