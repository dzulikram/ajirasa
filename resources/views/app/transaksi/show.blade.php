@extends('layouts.default')
@section('content')
    <!-- MAIN -->
    <style>
    	@media print {
   a[href]:after {
      display: none;
      visibility: hidden;
   }
}
    </style>
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h2 class="page-header">{{ $title }}</h2>
                    @if($pegawai)
                        @if($data->status == 'pending')
                            <h3 class="page-title">
                                <a href="{{ url('transaksi-ruangan/terima_transaksi',$data->id) }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('terima').submit();" class="btn btn-primary">
                                    Terima
                                </a>
                                <a href="{{ url('transaksi-ruangan/tolak_transaksi',$data->id) }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('tolak').submit();" class="btn btn-danger">
                                    Tolak
                                </a>
                            </h3>
                            @endif
                    @endif
                    <form id="terima" action="{{ url('transaksi-ruangan/terima_transaksi',$data->id) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <form id="tolak" action="{{ url('transaksi-ruangan/tolak_transaksi',$data->id) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @if($data->status == 'acc')
                        @if(!$pegawai)
                            <h3 class="page-title">
                                <button type="button" onclick="selesaiPinjam({{ $data->id }})" class="btn btn-default"><i class="fa fa-check-square-o"></i> Selesai </button>
                            </h3>
                            @endif
                        @endif
                    @if(isset($feedback))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Detail Hasil</h3>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td>Kritik :</td><td><p>{{ @$feedback->kritik }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama :</td><td>{{ @$feedback->saran }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Kondisi Ruangan</h3>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td>Gambar 1 :</td><td><img src="{{ storage_url('feedback/'.$feedback->lampiran_foto_1) }}" class="img-responsive"></td>
                                                </tr>
                                                <tr>
                                                    <td>Gambar 2 :</td><td><img src="{{ storage_url('feedback/'.$feedback->lampiran_foto_1) }}" class="img-responsive"></td>
                                                </tr>
                                               
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Informasi Peminjam</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>NIP :</td><td>{{ @$data->User->nrp }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama :</td><td>{{ @$data->User->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Telepon :</td><td>{{ @$data->User->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bagian :</td><td>{{ @$data->User->bagian_majelis }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Informasi Ruangan</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td><img src="{{ storage_url('ruangan/'.@$data->Ruangan->foto_ruangan) }}" class="img-responsive"> </td>
                                        </tr>
                                        <tr>
                                            <td>Kode Ruangan :</td><td>{{ @$data->Ruangan->kode_ruangan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ruangan :</td><td>{{ @$data->Ruangan->nama_ruangan }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Informasi Transaksi</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>Tanggal Transaksi :</td><td>{{ $data->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Peminjaman :</td><td>{{ $data->tanggal_peminjaman }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pengembalian :</td><td>{{ $data->tanggal_pengembalian }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Kegiatan :</td><td><p>{{ $data->deskripsi_kegiatan }}</p></td>
                                        </tr>
                                        <tr>
                                            <td>Lembar Persetujuan :</td><td><img class="img-responsive" src="{{ storage_url('transaksi/'.$data->scan_lembar_persetujuan) }}"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <div id="modal-feedback" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hasil Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" action="{{ url('transaksi-ruangan/store_feedback') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                               <textarea class="form-control" rows="3" name="kritik" placeholder="Berikan kritik anda..." required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="saran" placeholder="Berikan saran anda..." required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lampiran Foto 1</label>
                            <input type="file" class="form-control" name="lampiran_foto_1" required="">
                            <input type="hidden" class="form-control id_transaksi" name="id_transaksi" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lampiran Foto 2</label>
                            <input type="file" class="form-control" name="lampiran_foto_2" required="">
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selesaiPinjam(id){
            $("#modal-feedback").modal('show');
            $(".id_transaksi").val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '../transaksi_selesai',
                data: {id:id},
                success: function (data) {
                    console.log(data)
                }
            })
        }
        
        
    </script>
    <!-- END MAIN -->
@endsection