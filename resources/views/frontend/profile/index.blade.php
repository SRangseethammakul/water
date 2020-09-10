@extends('layouts.frontend')

@section('content')
<section class="content" id="app">

    <div class="container mt-5">
        <div class="container mb-3">
            <div class="row">
              <div class="col align-self-end">
                <a href="{{ route('profile.create')}}" class="btn btn-success">เพิ่มที่อยู่สำหรับการจัดส่ง</a>
              </div>
            </div>
        </div>
        @forelse ($profiles as $item)
        <div class="card">
            <div class="card-header">
              <h1>{{ $item->first_name }} {{ $item->last_name }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-2"><h2>หมายเลขโทรศัพท์</h2></div>
                    <div class="col-md-4 ml-auto"><h2>{{$item->profile_tel}}</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-2"><h2>ที่อยู่ในการจัดส่ง</h2></div>
                    <div class="col-md-4 ml-auto"><h2>{{$item->profile_address}}</h2></div>
                </div>
              <a href="#" class="btn btn-primary">แก้ไขข้อมูล</a>
            </div>
          </div>
        @empty
        <div class="card text-center">
            <div class="card-header">
                คุณยังไม่มีที่อยู่ในการจัดส่ง
            </div>
            <div class="card-body">
                <a href="{{ route('profile.create') }}" class="btn btn-primary">เพิ่มที่อยู่</a>
            </div>
        </div>
        @endforelse
    </div>
</section>




@endsection
@section('footerscript')
<script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function matchStart(params, data) {
            params.term = params.term || '';
            if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                return data;
            }
            return false;
        }
        $('.js-example-basic-single').select2({
            matcher: function (params, data) {
                return matchStart(params, data);
            }
        });
    });

</script>
@if(session('feedback'))
<script>
    Swal.fire(
        '{{ session('
        feedback ')}}', //
        'You clicked the button!',
        'success'
    )

</script>
@endif
@if(session('unsuccess'))    
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('unsuccess')}}'
    })
</script>
@endif
@endsection
