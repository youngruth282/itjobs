<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class RedirectIfNoSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sessiontimeout = 1800;//60*30 半小時
//https://int5.bolcc.tw/jobs/conn/88b27a9e72e0c8e2749c859b5eea8993

        if (!session('pid')) {
            // dd("BB");
            return redirect('https://int.bolcc.tw');
        }else{
            $timediff = Carbon::now()->diffInSeconds(session('timestamp')); // 0
            if ($timediff > $sessiontimeout){
                session()->flush();
                return redirect('https://int.bolcc.tw');
            }
            session(['timestamp' => now()]);
        }
        return $next($request);
    }
}
