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
                <h3 class="page-title"><a type="button" href="{{ route('transaksi-ruangan-app.create') }}" class="btn btn-default"><i class="fa fa-plus-square"></i> Ruangan Baru </a></h3>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BORDERED TABLE -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Daftar Ruangan</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Ruangan</th>
                                        <th>Nama Ruangan</th>
                                        <th>Status</th>
                                        <th>Ditambahkan Pada</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $i => $d)
                                        <tr>
                                            <td>{{ $i + 1}}</td>
                                            <td>{{ $d->kode_ruangan }}</td>
                                            <td>{{ $d->nama_ruangan }}</td>
                                            <td>{{ $d->status }}</td>
                                            <td>{{ $d->created_at  }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('transaksi-ruangan-app.edit',$d->id) }}" class="btn btn-default">Edit</a>
                                                    <form method="POST" action="{{ route('transaksi-ruangan-app.destroy',$d->id)  }}'" style="display:inline">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $data->render() }}
                            </div>
                        </div>
                        <!-- END BORDERED TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>

    <!-- END MAIN -->
@endsection