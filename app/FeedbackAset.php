<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackAset extends Model
{
    protected $table = 'feedback_transaksi_aset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_transaksi_aset', 'kritik', 'saran', 'lampiran_foto_1', 'lampiran_foto_2'
    ];

    public function TransaksiAset()
    {
        return $this->belongsTo('\App\TransaksiAset','id_transaksi');
    }
}
