@extends('layouts.backend')
@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Permission</h1>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <br>
    <section class="content" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto ml-auto">
                    <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#permissionModal">เพิ่ม Permission</a>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{ route('permission.edit',['id'=>$item->id])}}" class="btn btn-info mr-2">
                                            <li class="fa fa-pencil text-white"></li>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end row --}}
        </div>
    </section>
    @include('backend.permission.add');
@endsection

@section('footerscript')
<script type="text/javascript">
    var _xhr;
    $(function () {
        $('table').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    $('#saveBtn').on('click', function () {
        $.ajax({
            data: $('#permissionForm').serialize(),
            url: "{{ route('permission.store')}}",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    $('#permissionForm').trigger("reset");
                    $('#permissionModal').modal('hide');
                    location.reload();
                }
            },
            error: function (response) {
                $('#saveBtn').html('Save Changes');
            }
        });
    });
</script>
@if(session('feedback'))
<script>
    Swal.fire(
        '{{ session('feedback')}}',
        'You clicked the button!',
        'success'
    );
</script>
@endif
@endsection