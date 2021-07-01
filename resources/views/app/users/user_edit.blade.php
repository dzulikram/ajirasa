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
                <h4 class="page-title">Add New User</h4>
                    {!! Form::model($data, ['method' => 'PATCH','route' => ['pengguna.update', $data->id], 'enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $data->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $data->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Role</label>
                            <select name="id_role" class="form-control">
                                <option value="" selected disabled>--Select an Option--</option>
                                @foreach($roles as $r)
                                    <option value="{{ $r->id_role }}" {{ $r->id_role == $data->role ? "selected" : "" }}>{{ $r->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kunci</label>
                            <select class="form-control" name="kunci">
                                <option value="1" {{ ($data->kunci) ? "selected" : "" }}>Yes</option>
                                <option value="0" {{ ($data->kunci) ? "selected" : "" }}>No</option>
                            </select>
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