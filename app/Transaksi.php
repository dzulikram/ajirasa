<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'id_ruangan', 'tanggal_peminjaman', 'tanggal_pengembalian', 'deskripsi_kegiatan', 'scan_lembar_persetujuan', 'status'
    ];

    public function User()
    {
        return $this->belongsTo('App\User','id_user');
    }

    public function Ruangan()
    {
        return $this->belongsTo('App\Ruangan','id_ruangan');
    }
}
