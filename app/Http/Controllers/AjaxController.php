<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Transaksi;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function transaksiSelesai(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $transaksi->update([
                'status' => 'selesai'
            ]);
        Ruangan::find($transaksi->id_ruangan)
            ->update([
                'status' => 'tersedia'
            ]);
    }
}
