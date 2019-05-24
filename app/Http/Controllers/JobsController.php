<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;
use App\Counter;
use App\Myuser;
use App\Dept;
use Carbon\Carbon;
use App\Exports;

// use App\Exports\JobssExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JobsController extends Controller
{
    private $pageLineCount=10;

    public function __construct()
    {
        $this->middleware(['chkuser'])->except(['memconfirm']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//
        $whichmode= "P";//個人
        $searchKey="";
        $status='N';//進行中
        $orderSeq='desc';//最近的先
        $user_name = session('user_name');//預設
        $dept_name = session('dept_name');//預設
        $pid = session('pid');//預設
        $hr_sn = session('hr_sn');//預設
        $crewid = session('pid');//選取項
        // $deptid = session('hr_sn');//選取項

        $jobs = Job::ViewInfo($status)->where('req_pid', $pid)->SearchGroup($searchKey, $status)/*->orderBy('app_duedate', $orderSeq)*/->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);//此處不能使用，第二頁會出錯
        $num = $jobs->count();

        // $depts= Dept::orderBy('hr_sn')->pluck('dept_name', 'hr_sn');
        $crews= Myuser::Crews($hr_sn)->pluck('user_name', 'pid');

        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'status', 'orderSeq', 'whichmode', 'crews', 'crewid', 'pid'));//, 'status'

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $whichmode= "P";
        $depts = Dept::orderBy('hr_sn')->pluck('dept_name','hr_sn');

        $user_name = session('user_name');//預設
        $dept_name = session('dept_name');//預設
        // $pid = session('pid');//預設
        // $hr_sn = session('hr_sn');//預設
        // $crewid = session('pid');//選取項
        $deptid = session('hr_sn');//選取項

        $pid = session('pid');
        $num = Job::where('req_pid', $pid)->count();
        // $pid = session('pid');
        $deptid = session('hr_sn');
        $status="N";//$request->status;

        return view('jobs.create', compact('num', 'user_name', 'dept_name', 'deptid', 'depts', 'status', 'whichmode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'app_crewname' => 'required'
            ]);
        $job = Job::create($request->all());
        $count = Counter::Getcounter('job');
        $app_no=date("ymd")."-".str_pad($count, 3, "0",STR_PAD_LEFT);
        $pid = session('pid');//預設
        Job::find($job->id)->update(['app_no'=> $app_no, 'req_pid' => $pid]);//, 'user_name' => $user_name
        //flash('新增成功');
        return redirect()->route('jobs.search');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $whichmode= "P";
        $user_name = session('user_name');//預設
        $dept_name = session('dept_name');//預設
        $pid = session('pid');//預設
        // $hr_sn = session('hr_sn');//預設
        // $crewid = session('pid');//選取項
        $deptid = session('hr_sn');//選取項

        $depts = Dept::orderBy('hr_sn')->pluck('dept_name','hr_sn');
        $num = Job::where('req_pid', $pid)->count();
        $job = Job::ViewInfo('N')->where('req_pid', $pid)->where('jobs.id', $id)->firstOrFail();

        $status="N";//才能修改

        return view('jobs.edit', compact('job', 'num', 'user_name', 'dept_name', 'depts', 'deptid', 'status', 'whichmode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Job::find($id)->update($request->all());
        if ($request->app_status=="Y") Job::find($id)->update(['app_progress'=> '已完成']);
        return redirect()->route('jobs.search');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::destroy($id);
        return redirect()->route('jobs.search');
    }
    public function search(Request $request)
    {
        /*if (!session('user')) {
            return redirect('http://int.bolcc.tw');
        }*/
        $whichmode= "P";//個人
        $searchKey="";
        $status='N';//進行中
        $orderSeq='desc';//最近的先
        $user_name = session('user_name');//預設
        $dept_name = session('dept_name');//預設
        $pid = session('pid');//預設
        $hr_sn = session('hr_sn');//預設
        $crewid = session('pid');//選項
        // $deptid = session('hr_sn');

        $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)->where('req_pid', $pid)/*->orderBy('app_duedate', $orderSeq)*/->orderBy('app_no', $orderSeq)->get();//->paginate($this->pageLineCount);此處不能使用，第二頁會出錯
        $num = $jobs->count();

        // $depts= Dept::orderBy('hr_sn')->pluck('dept_name', 'hr_sn');
        // $hr_sn = 110;
        $crews= Myuser::Crews($hr_sn)->pluck('user_name', 'pid');

        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'status', 'orderSeq', 'whichmode', 'crews', 'crewid', 'pid'));//, 'status'

        // return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'deptid', 'depts', 'status', 'orderSeq', 'pid', 'whichmode'));//, 'status'
    }
    public function getsearch(Request $request)
    {
        $whichmode=$request->whichmode;
        
        $status=$request->status;
        //if ($status=='0') $status='N';
        /*$orderSeq='asc';
        if ($status != 'N') $orderSeq='desc';*/
        $orderSeq=$request->orderSeq;
        
        if ($request->searchKey) $searchKey=$request->searchKey;
        else $searchKey="";
        if ($whichmode == "P"){
            $crewid = session('pid');
            // $deptid = session('hr_sn');
            $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)->where('req_pid', $crewid)/*->orderBy('app_duedate', $orderSeq)*/->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);//此處不能使用，第二頁會出錯->get();//
            $num = $jobs->count();
            $user_name = Myuser::where('pid', $crewid)->first()->user_name;//
        }else{
            $crewid=$request->crewid;
            if ($crewid>0) {
                $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)->where('req_pid', $crewid)/*->orderBy('app_duedate', $orderSeq)*/->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);//此處不能使用，第二頁會出錯
                $num = $jobs->count();
                $user_name = Myuser::where('pid', $crewid)->first()->user_name;//
            } else {
                $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)/*->orderBy('app_duedate', $orderSeq)*/->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);//此處不能使用，第二頁會出錯
                $num = $jobs->count();
                $user_name = "全部";
            }
        }

        $deptid = session('hr_sn');
        $pid = session('pid');
        // $depts= Dept::orderBy('hr_sn')->pluck('dept_name', 'hr_sn');
        $dept_name = session('dept_name');
        $crews= Myuser::Crews($deptid)->pluck('user_name', 'pid');
        // $crewid = session('pid');

        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'status', 'orderSeq', 'whichmode', 'crews', 'crewid', 'pid'));//, 'status'
        // return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'deptid', 'depts', 'status', 'orderSeq', 'searchKey', 'pid', 'whichmode'));//
    }
    public function export(Request $request)
    {
        
        // return \Excel::download(new Exports\JobsExport(), 'test.xls');

    }
    public function memconfirm($id){
            $regPerson=\App\Member::where('req_id', $id)->firstOrFail();
            $data = ['req_id' => $id,
            'tid' => $regPerson->tid,
            'newmem_name' => $regPerson->newmem_name,
            'leader_name' => $regPerson->leader_name];
        $per_email = $regPerson->newmem_email;
        // $ts = microtime();
        $subject = "台北靈糧堂 牧養處及事工管理處 組員邀請通知";//.substr($ts, -5);
        \Mail::send(['html' =>'emails.member_confirm'], $data, function ($message) use ($per_email, $subject) {
            $per_email = "young.ruth@gmail.com";
            $message->to($per_email)->subject($subject);
        });
        // if (\Mail::failures()) {
        //     if ($pid==0)//線上報名
        //         \App\RegYoyo::where('y_id', $yid)->update(['y_status' => 'O']);//需要重送信
        //     return redirect('https://int2.bolcc.tw/Equip_int/yoyoregMan201904.php');
        // }
    
        return redirect('https://int.bolcc.tw/mem/user');
    }
}
