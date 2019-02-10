<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Job;

class JobstestExport implements FromView
{
    public function view(): View
    {
        $pid = session('pid');
        $user_name = session('user_name');
        $deptid = session('hr_sn');
        $dept_name = session('dept_name');
        //$status='A'; $orderSeq='desc';
        $status='N';
        $orderSeq='desc';

        $jobs = \App\Job::ViewInfo($status)->where('req_pid', $pid)->orderBy('app_no', $orderSeq)->get();
//        $num = Job::where('app_status', $status)->where('req_pid', $pid)->count();//只顯示進行中專案
// return view('jobs.jv02', compact('jobs'));
return view('jobs.jv02');
}
}
