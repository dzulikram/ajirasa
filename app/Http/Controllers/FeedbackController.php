<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $l1 = sha1(date('ymdhis')).'.'.request()->lampiran_foto_1->getClientOriginalExtension();
        Storage::putFileAs('public/feedback', $request->file('lampiran_foto_1'),$l1);
        $l2 = sha1(date('ymdhis')).'.'.request()->lampiran_foto_2->getClientOriginalExtension();
        Storage::putFileAs('public/feedback', $request->file('lampiran_foto_2'),$l2);
      

        Feedback::create([
            'id_transaksi' => $request->id_transaksi ,
            'kritik' => $request->kritik,
            'saran' => $request->saran,
            'lampiran_foto_1' => $l1,
            'lampiran_foto_2' => $l2,
           
        ]);

        return redirect('transaksi-ruangan/daftar-transaksi')
            ->with('success','feedback anda telah tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
