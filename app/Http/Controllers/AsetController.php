<?php

namespace App\Http\Controllers;

use App\Aset;
use App\TransaksiAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Aset::orderBy('id',"DESC")
            ->paginate(10);

        return view('app.aset.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.aset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = sha1(date('ymdhis')).'.'.request()->foto_aset->getClientOriginalExtension();
        Storage::putFileAs('public/aset', $request->file('foto_aset'),$image);
        Aset::create([
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'status' => $request->status,
            'foto_aset' => $image
        ]);

        return redirect()
            ->route('aset.index')
            ->with('success','Sukses menambahkan aset baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Aset::find($id);
        $transaksi = TransaksiAset::where('id_aset',$id)
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('app.aset.show',compact('data','transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Aset::find($id);
        return view('app.aset.edit',compact('data'));
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
        $find = Aset::find($id);
        $image = $find->foto_aset;
        if($request->foto_aset){
            $image = sha1(date('ymdhis')).'.'.request()->foto_aset->getClientOriginalExtension();
            Storage::putFileAs('public/aset', $request->file('foto_aset'),$image);
        }

        $find->update([
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'status' => $request->status,
            'foto_aset' => $image
        ]);

        return redirect()
            ->route('aset.index')
            ->with('success','Sukses mengupdate aset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aset::destroy($id);
        return redirect()
            ->route('aset.index')
            ->with('success','Sukses menghapus aset');
    }
}
