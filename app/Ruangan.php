<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primarykey = 'id';
    protected $fillable = [
        'kode_ruangan', 'nama_ruangan', 'status', 'foto_ruangan'
    ];
}
