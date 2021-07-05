@extends('layouts.default')
@section('content')
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h2 class="page-header">Detail Aset</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <img src="{{ storage_url('aset/'.$data->foto_aset) }}" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Informasi Aset</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>Kode Aset :</td><td>{{ $data->kode_aset }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Aset :</td><td>{{ $data->nama_aset }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Peminjam</th>
                                    <th rowspan="2">Aset</th>
                                    <th colspan="3" class="text-center">Tanggal</th>
                                    <th rowspan="2">Status</th>
                                </tr>
                                <tr>
                                    <th>Transaksi</th>
                                    <th>Pinjam</th>
                                    <th>Kembali</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transaksi as $i => $d)
                                    <tr>
                                        <td>{{ $i + 1}}</td>
                                        <td>{{ $d->User->nrp }}</td>
                                        <td>{{ $d->Aset->kode_aset }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->tanggal_peminjaman }}</td>
                                        <td>{{ $d->tanggal_pengembalian }}</td>
                                        <td><a href="{{ url('transaksi-aset/show-transaksiaset',$d->id) }}" class="btn btn-link">{{ strtoupper($d->status) }}</a>  </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $transaksi->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>

    <!-- END MAIN -->
@endsection