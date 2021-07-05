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
                <input type="button" class="btn btn-info" onclick="printDiv('printableArea')" value="Print!" />
<div id="printableArea">
 <style>
    	@media print {
   a[href]:after {
      display: none;
      visibility: hidden;
   }
}
    </style>
                  <div class="row">
                    <div class="col-md-12">
                        <!-- BORDERED TABLE -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Laporan</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
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
                                    @foreach($data as $i => $d)
                                        <tr>
                                            <td>{{ $i + 1}}</td>
                                            <td>{{ @$d->User->nrp }}</td>
                                            <td>{{ @$d->Aset->kode_aset }}</td>
                                            <td>{{ $d->created_at }}</td>
                                            <td>{{ $d->tanggal_peminjaman }}</td>
                                            <td>{{ $d->tanggal_pengembalian }}</td>
                                            <td><a href="{{ url('transaksi-aset/show-transaksiaset',$d->id) }}" class="btn btn-link">{{ strtoupper($d->status) }}</a>   </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <!-- END BORDERED TABLE -->
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
    <!-- END MAIN -->
@endsection