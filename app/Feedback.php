<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_transaksi', 'kritik', 'saran', 'lampiran_foto_1', 'lampiran_foto_2'
    ];

    public function Transaksi()
    {
        return $this->belongsTo('\App\Transaksi','id_transaksi');
    }
}
