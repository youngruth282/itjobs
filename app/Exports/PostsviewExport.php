<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PostsviewExport implements FromView
{
    public function view(): View
    {
        $pid = session('pid');
        $user_name = session('user_name');
        $deptid = session('hr_sn');
        $dept_name = session('dept_name');
        $status='N';
        $orderSeq='desc';

        $jobs = Job::ViewInfo($status)->where('req_pid', $pid)->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);
        $num = Job::where('req_pid', $pid)->count();
        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'deptid', 'status'));
    }
}