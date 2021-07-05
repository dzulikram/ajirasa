<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Ruangan;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends BaseController
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
            $data = Transaksi::orderBy('id','desc')
                ->paginate(10);
        }else{
            $data = Transaksi::where('id_user',$user->id)
                ->orderBy('id','desc')
                ->paginate(10);
        }


        return view('app.transaksi.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $nrp = User::find(Auth::id())->nrp;
        $ruangan = Ruangan::find($id);
        return view('app.transaksi.create',compact('nrp','ruangan'));
    }
    
    public function laporan()
    {
        
        return view('app.transaksi.laporan');
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
        Storage::putFileAs('public/transaksi', $request->file('scan_lembar_persetujuan'),$sp);

        Transaksi::create([
            'id_user' => Auth::id(),
            'id_ruangan' => $request->id_ruangan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            
            'scan_lembar_persetujuan' => $sp,
            'status' => 'pending'
        ]);

        $username = User::find(Auth::id())->username;
        $ruangan = Ruangan::find($request->id_ruangan);
        $message = "PEMINJAMAN SARANA & FASILITAS UIW KALTIMRA
=======*Ruangan*=======
Permintaan Peminjaman *".$ruangan->nama_ruangan."*
Pada Tanggal *".$request->tanggal_peminjaman."*
Oleh *".$username."*";
	    $this->sendWa($message,'6281385282208');
        $this->sendWa($message,'6282157707012');
        $this->sendWa($message,'6281283442713');

        return redirect('transaksi-ruangan/daftar-transaksi')
            ->with('success','Transaksi anda sedang di proses');

    }

    public function sendWa($message,$destination)
	{
		$curl = curl_init();
		$token = "EiAM1JO0FD7vMBsqP5gERYBbQEn7rdm9QD3QekEXvgiWgvXwvsiC6gCS7lNizJUu";
		$data = [
		    'phone' => $destination,
		    'message' => $message,
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER,
		    array(
		        "Authorization:".$token,
		    )
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://sambi.wablas.com/api/send-message");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);

		// echo "<pre>";
		// print_r($result);
        // echo "</pre>";       
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::find($id);
        $title = "Detail Transaksi";
        
        if($data->status == 'selesai'){
            $feedback = Feedback::where('id_transaksi',$id)
                ->first();
            $title = "Detail Hasil Transaksi";
        }else{
			$feedback = Feedback::where('id_transaksi',$id)
                ->first();
		}
        $user = User::find(Auth::id());
        if($user->pegawai == 1){
            $pegawai = TRUE;
        }else{
            $pegawai = FALSE;
        }
        return view('app.transaksi.show',compact('data','feedback','title','pegawai'));
    }
    
     public function lap_aksi(Request $request)
    {
        $data = Transaksi::whereYear('tanggal_peminjaman',$request->tahun)
        		->whereMonth('tanggal_peminjaman',$request->bulan)
                ->orderBy('tanggal_peminjaman','desc')->get();
          
      return view('app.transaksi.lihat_laporan',compact('data'));
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function terima($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => 'acc'
        ]);

        Ruangan::find($transaksi->id_ruangan)
            ->update([
                'status' => 'dipinjam'
            ]);

        return redirect('transaksi-ruangan/daftar-transaksi')
            ->with('success','sukses merubah status transaksi');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolak($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => 'tolak'
        ]);

        return redirect('transaksi-ruangan/daftar-transaksi')
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
