<?php
/**
 * Created by PhpStorm.
 * User: Irman
 * Date: 5/7/2018
 * Time: 6:11 PM
 */

namespace App\Http\Middleware;
use Closure;

class Cors {

    /**
     * @param $request
     * @param callable $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
            ->header('Access-Control-Allow-Credentials',' true');
    }
}