<?php

namespace App\Http\Controllers;

use App\FeedbackAset;
use App\Aset;
use App\TransaksiAset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiAsetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\User::find(Auth::id());
        if($user->pegawai == 1){
            $data = TransaksiAset::orderBy('id','desc')
                ->paginate(10);
        }else{
            $data = TransaksiAset::where('id_user',$user->id)
                ->orderBy('id','desc')
                ->paginate(10);
        }


        return view('app.transaksiaset.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $nrp = User::find(Auth::id())->nrp;
        $aset = Aset::find($id);
        return view('app.transaksiaset.create',compact('nrp','aset'));
    }
    
    public function laporan()
    {
        
        return view('app.transaksiaset.laporan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$ktm = sha1(date('ymdhis')).'.'.request()->scan_ktm->getClientOriginalExtension();
        //Storage::putFileAs('public/transaksi', $request->file('scan_ktm'),$ktm);
        $sp = sha1(date('ymdhis')).'.'.request()->scan_lembar_persetujuan->getClientOriginalExtension();
        Storage::putFileAs('public/transaksiaset', $request->file('scan_lembar_persetujuan'),$sp);

        TransaksiAset::create([
            'id_user' => Auth::id(),
            'id_aset' => $request->id_aset,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'deskripsi_penggunaan' => $request->deskripsi_penggunaan,
            
            'scan_lembar_persetujuan' => $sp,
            'status' => 'pending'
        ]);


        return redirect('daftar-transaksiaset')
            ->with('success','Transaksi anda sedang di proses');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TransaksiAset::find($id);
        $title = "Detail Transaksi";
        
        if($data->status == 'selesai'){
            $feedback = FeedbackAset::where('id_transaksi_aset',$id)
                ->first();
            $title = "Detail Hasil Transaksi";
        }else{
			$feedback = FeedbackAset::where('id_transaksi_aset',$id)
                ->first();
		}
        $user = User::find(Auth::id());
        if($user->pegawai == 1){
            $pegawai = TRUE;
        }else{
            $pegawai = FALSE;
        }
        return view('app.transaksiaset.show',compact('data','feedback','title','pegawai'));
    }
    
     public function lap_aksi(Request $request)
    {
        $data = TransaksiAset::whereYear('tanggal_peminjaman',$request->tahun)
        		->whereMonth('tanggal_peminjaman',$request->bulan)
                ->orderBy('tanggal_peminjaman','desc')->get();
          
      return view('app.transaksiaset.lihat_laporan',compact('data'));
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function terima($id)
    {
        $transaksi = TransaksiAset::find($id);
        $transaksi->update([
            'status' => 'acc'
        ]);

        Aset::find($transaksi->id_aset)
            ->update([
                'status' => 'dipinjam'
            ]);

        return redirect('daftar-transaksiaset')
            ->with('success','sukses merubah status transaksi');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolak($id)
    {
        $transaksi = TransaksiAset::find($id);
        $transaksi->update([
            'status' => 'tolak'
        ]);

        return redirect('daftar-transaksiaset')
            ->with('success','sukses merubah status transaksi');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
