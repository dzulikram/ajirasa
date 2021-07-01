@extends('layouts.default')
@section('content')
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="page-title">Menambah data admin</h4>
                {!! Form::open(array('route' => 'user.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">NIP Pegawai</label>
                            <input type="text" class="form-control" name="username" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama Pegawai</label>
                            <input type="name" class="form-control" name="name" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">No. Telpon </label>
                            <input type="text" class="form-control" name="no_telp" required="">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->

@endsection