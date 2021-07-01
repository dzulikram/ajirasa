@extends('layouts.default')
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <h4 class="page-title">Dashboard / Pinjam Ruang</h4>
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="{{ $item->status == 'booking' ? 'background:red;' : 'background:green;' }}">
                                    <h3 class="panel-title text-center" style="color: #FFFFFF;">{{ $item->kode_ruangan }}</h3>
                                </div>
                                <div class="panel-body">
                                    <img src="{{ storage_url('ruangan/'.$item->foto_ruangan) }}" width="100%">
                                </div>
                                <div class="panel-body">
                                    <p class="text-center">{{ $item->nama_ruangan }}</p>
                                    <p class="text-center">{{ strtoupper($item->status) }}</p>
                                </div>
                                <div class="panel-footer">
                                    <div class="btn-group-justified">
                                        <a href="{{ route('ruangan.show',$item->id) }}" class="btn btn-primary">Detail</a>
                                        <a href="{{ url('create-transaksi',$item->id) }}" class="btn btn-success">Pinjam</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ $data->render() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    @endsection
