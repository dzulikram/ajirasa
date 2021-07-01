<?php
/**
 * Created by PhpStorm.
 * User: Irman
 * Date: 3/26/2018
 * Time: 6:36 PM
 */

if (! function_exists('format_tgl')) {

    function format_tgl($input)
    {
        $bln = ['','Jan','Feb','Mar','April','Mei','Juni','Juli','Agu','Sep','Okt','Nov','Des'];
        $tgl = explode(" ",$input)[0];
        $split = explode("-",$tgl);

        return $split[2].' '.$bln[intval($split[1])].' '.$split[0];
    }

    function storage_url($loc)
    {
        return url('storage/app/public/'.$loc);
    }
}
