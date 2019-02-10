<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{//user_name 申請人姓名目前不能刪, 已可刪0419
    protected $guarded = [];//'app_no', 'req_pid', 'user_name', 'deleted_at'];

    // public function scopeUnDeleted($query)
    // {
    //     return $query->where('deleted_at', NULL);
    // }
    public function scopeJoinTbl($query)
    {
        return $query->leftJoin('myusers', 'jobs.req_pid','myusers.pid')->leftJoin('depts', 'jobs.app_deptid','depts.hr_sn');
    }
    public function scopeViewInfo($query, $status)
    {
        if ($status=="A")
            return $query->JoinTbl()->selectRaw('jobs.*, myusers.user_name, depts.dept_name');
        else
            return $query->JoinTbl()->where('jobs.app_status', $status)->selectRaw('jobs.*, myusers.user_name, depts.dept_name');

    }
    public function scopeSearchGroup($query, $keyword, $status)
    {
        //$query = $query->where('jobs.app_status', $status);
        if ($keyword){
            if ($status=="A")
                return $query->where('app_item', 'LIKE', '%' . $keyword . '%')->orWhere('app_content', 'LIKE', '%' . $keyword . '%')->orWhere('app_memo', 'LIKE', '%' . $keyword . '%');
            else
                return $query->where('app_status', $status)->where('app_item', 'LIKE', '%' . $keyword . '%')->orWhere('app_content', 'LIKE', '%' . $keyword . '%')->orWhere('app_memo', 'LIKE', '%' . $keyword . '%');
        }else{
            if ($status=="A")
                return $query;
            else
                return $query->where('app_status', $status);
        }
    }
    public function scopeExcelInfo($query, $deptid, $pid, $status)
    {
        if ($deptid==-1){//個人，所有部門。所有狀態
            return $query->JoinTbl()->where('jobs.req_pid', $pid)->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')->orderBy('jobs.app_no');
        }elseif ($deptid==0){//所有部門。分狀態
            if ($status=="A")
                return $query->JoinTbl()->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')->orderBy('jobs.app_no');
            else
                return $query->JoinTbl()->where('jobs.app_status', $status)->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')->orderBy('jobs.app_no');
        }else{//部門，分狀態
            if ($status=="A")
                return $query->JoinTbl()->where('jobs.app_deptid', $deptid)->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')->orderBy('jobs.app_no');
            else
                return $query->JoinTbl()->where('jobs.app_deptid', $deptid)->where('jobs.app_status', $status)->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')->orderBy('jobs.app_duedate');
        }
    }

    public function setAppDuedateAttribute($date)
    {
        $this->attributes['app_duedate'] = Carbon::parse($date);
    }

    public function getAppDuedateAttribute($date)
    {//epsodies 27
        //return new Carbon($date);
        return Carbon::parse($date)->format('Y-m-d');
    }
}
