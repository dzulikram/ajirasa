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
                <h4 class="page-title">Detail</h4>
                {!! Form::open(array('route' => 'user.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">NIP</label>
                            <input type="text" class="form-control" readonly name="username" value="{{ $data->nrp }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <input type="name" class="form-control" readonly name="name" value="{{ $data->name }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">No. Telpon </label>
                            <input type="text" class="form-control" readonly name="no_telp" value="{{ $data->no_telp }}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
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