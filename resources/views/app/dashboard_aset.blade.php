@extends('layouts.default')
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <h4 class="page-title">Dashboard / Pinjam Aset</h4>
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="{{ $item->status == 'booking' ? 'background:red;' : 'background:green;' }}">
                                    <h3 class="panel-title text-center" style="color: #FFFFFF;">{{ $item->kode_aset }}</h3>
                                </div>
                                <div class="panel-body">
                                    <img src="{{ storage_url('aset/'.$item->foto_aset) }}" width="100%">
                                </div>                                
                                <div class="panel-body">
                                    <p class="text-center">{{ $item->nama_aset }}</p>
                                    <?php if($item->status == 'dipinjam'){ ?>
                                    <p class="text-center" style="color:white; background-color:Tomato;">{{ strtoupper($item->status) }}</p>
                                    <?php } else { ?>
                                    <p class="text-center">{{ strtoupper($item->status) }}</p>
                                    <?php } ?>
                                </div>
                                <div class="panel-footer">
                                    <div class="btn-group-justified">
                                        <a href="{{ route('transaksi-aset-app.show',$item->id) }}" class="btn btn-primary">Detail</a>
                                        <?php if($item->status == 'dipinjam'){ ?>
                                        <a href="#" class="btn btn-success">Pinjam</a>
                                        <?php } else { ?>
                                        <a href="{{ url('pinjam-aset/create-transaksiaset',$item->id) }}" class="btn btn-success">Pinjam</a>
                                        <?php } ?>                                        
                                        
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
