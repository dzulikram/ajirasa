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
                <h4 class="page-title">Transaksi Baru</h4>
                <form method="post" action="{{ url('store_transaksiaset') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">NIP Pegawai</label>
                                <input type="text" class="form-control" name="nrp" value="{{ $nrp }}" readonly>
                                <input type="hidden" class="form-control" name="id_aset" value="{{ $aset->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kode aset</label>
                                <input type="text" class="form-control" name="kode_aset" value="{{ $aset->nama_aset .' - '.$aset->kode_aset }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tanggal Peminjaman</label>
                                <input type="text" name="tanggal_peminjaman" class="form-control tanggal"  required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tanggal Pengembalian</label>
                                <input type="text" name="tanggal_pengembalian" class="form-control tanggal"  required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi Penggunaan</label>
                                <textarea name="deskripsi_penggunaan" class="form-control"  required="" rows="3" placeholder="jelaskan tujuan penggunaannya"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Scan Lembar Persetujuan</label>
                                <input type="file" name="scan_lembar_persetujuan" class="form-control"  required="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Transaksi</button>
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