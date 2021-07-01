<?php

namespace App\Http\Controllers;

use App\Aset;
use App\TransaksiAset;
use Illuminate\Http\Request;

class AjaxAsetController extends Controller
{
    public function transaksiSelesai(Request $request)
    {
        $transaksi = TransaksiAset::find($request->id);
        $transaksi->update([
                'status' => 'selesai'
            ]);
        Aset::find($transaksi->id_ruangan)
            ->update([
                'status' => 'tersedia'
            ]);
    }
}
