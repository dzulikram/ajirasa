<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    protected $primarykey = 'id';
    protected $fillable = [
        'kode_aset', 'nama_aset', 'status', 'foto_aset'
    ];
}
