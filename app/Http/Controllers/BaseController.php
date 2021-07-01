<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public static function is_pegawai($id)
    {
        $user = User::find($id);

        if($user->pegawai == 1){
            return true;
        }

        return false;
    }
    
    public static function is_manajer($id)
    {
        $user = User::find($id);

        if($user->pegawai == 2){
            return true;
        }

        return false;
    }

}
