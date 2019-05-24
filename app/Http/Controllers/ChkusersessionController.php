<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myuser;
//https://int5.bolcc.tw/jobs/conn/88b27a9e72e0c8e2749c859b5eea8993

class ChkusersessionController extends Controller
{
    
    public function decode($id)
    {
        // $myuser = Myuser::leftJoin('depts', 'depts.hr_sn', 'myusers.hr_sn')->where('myusers.hashname' , $id)->first();
        // session(['user_name' => $myuser['user_name'], 'pid' => $myuser['pid'], 'hr_sn' => $myuser['hr_sn'], 'dept_name' => $myuser['dept_name'], 'timestamp' => now()]);
        $myuser = Myuser::where('hashname', $id)->first();
        session(['user_name' => $myuser['user_name'], 'pid' => $myuser['pid'], 'hr_sn' => $myuser['hr_sn'], 'dept_name' => $myuser['dept_nameXX'], 'timestamp' => now()]);
        session(['searchstatus'=> 'N']);//此為jobs
        // echo $id;
        // dd(session('pid'));
        return redirect()->route('jobs.index');
    }
    public function clear(Request $request)
    {
        $request->session()->flush();
        return redirect('https://int.bolcc.tw');
    }

}
