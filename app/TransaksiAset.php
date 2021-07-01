<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiAset extends Model
{
    protected $table = 'transaksi_aset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'id_aset', 'tanggal_peminjaman', 'tanggal_pengembalian', 'deskripsi_penggunaan', 'scan_lembar_persetujuan', 'status'
    ];

    public function User()
    {
        return $this->belongsTo('App\User','id_user');
    }

    public function Aset()
    {
        return $this->belongsTo('App\Aset','id_aset');
    }
}
