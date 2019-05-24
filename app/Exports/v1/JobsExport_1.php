<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class JobsExport implements FromQuery
{
    use Exportable;

    public function __construct(int $deptid, int $pid, string $status)
    {
        $this->deptid = $deptid;
        $this->pid = $pid;
        $this->status = $status;
    }

    public function query()
    {
        if ($this->status=="Y") $status=$this->status;
        else $status=NULL;
        if ($this->deptid==0) return \App\Job::ViewInfo($status)->where('req_pid', $this->pid)->oldest('app_duedate', 'app_no');
        else return \App\Job::ViewInfo($status)->where('app_deptid', $this->deptid)->oldest('app_duedate', 'app_no');
    }
}