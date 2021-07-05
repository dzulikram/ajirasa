<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ruangan::orderBy('id',"DESC")
            ->paginate(10);

        return view('app.ruangan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = sha1(date('ymdhis')).'.'.request()->foto_ruangan->getClientOriginalExtension();
        Storage::putFileAs('public/ruangan', $request->file('foto_ruangan'),$image);
        Ruangan::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status,
            'foto_ruangan' => $image
        ]);        

        return redirect()
            ->route('transaksi-ruangan-app.index')
            ->with('success','Sukses menambahkan ruangan baru');
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ruangan::find($id);
        $transaksi = Transaksi::where('id_ruangan',$id)
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('app.ruangan.show',compact('data','transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ruangan::find($id);
        return view('app.ruangan.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $find = Ruangan::find($id);
        $image = $find->foto_ruangan;
        if($request->foto_ruangan){
            $image = sha1(date('ymdhis')).'.'.request()->foto_ruangan->getClientOriginalExtension();
            Storage::putFileAs('public/ruangan', $request->file('foto_ruangan'),$image);
        }

        $find->update([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status,
            'foto_ruangan' => $image
        ]);

        return redirect()
            ->route('transaksi-ruangan-app.index')
            ->with('success','Sukses mengupdate ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ruangan::destroy($id);
        return redirect()
            ->route('transaksi-ruangan-app.index')
            ->with('success','Sukses menghapus ruangan');
    }
}
