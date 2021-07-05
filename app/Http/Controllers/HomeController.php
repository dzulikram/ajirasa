<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Aset;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('pinjam-ruangan');
    }

    public function indexruangan()
    {
        $data = Ruangan::orderBy('kode_ruangan','ASC')
            ->paginate(10);
        return view('app.dashboard',compact('data'));
    }

    public function indexaset()
    {
        $data = Aset::orderBy('kode_aset','ASC')
            ->paginate(10);
        return view('app.dashboard_aset',compact('data'));
    }
}
