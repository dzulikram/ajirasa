@extends('layouts.default')
@section('content')
    <!-- MAIN -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery.ui-timepicker.css') }}">
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
                <h4 class="page-title">Laporan</h4>
                <form method="post" action="{{ url('lap_aksi') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Bulan</label>
                               <select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" class="form-control" id="tag_select" name="bulan">
        <option value="0" selected disabled> Pilih Bulan</option>
	<option value="01"> Januari</option>
	<option value="02"> Februari</option>
	<option value="03"> Maret</option>
	<option value="04"> April</option>
	<option value="05"> Mei</option>
	<option value="06"> Juni</option>
	<option value="07"> Juli</option>
	<option value="08"> Agustus</option>
	<option value="09"> September</option>
	<option value="10"> Oktober</option>
	<option value="11"> November</option>
	<option value="12"> Desember</option>
	</select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tahun</label>
                                <input type="text" class="form-control" name="tahun" value="<?php echo date("Y");?>">
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
                </form>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->

    <script src="{{ asset('assets/vendor/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui-timepicker-addon.js') }}"></script>
    <script>
        $(document).ready(function(){
            jQuery('.tanggal').datetimepicker({"dateFormat":"yy-mm-dd","timeFormat":"HH:mm:ss","showSecond":true,"minDateTime" : new Date()});

        })
    </script>
@endsection