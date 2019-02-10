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
        $this->middleware(['chkuser']);//->except(['decode', 'clear']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = Dept::orderBy('hr_sn')->pluck('dept_name','hr_sn');
        //dd($depts);
        $num = Job::all()->count();
        $user_name = session('user_name');
        $dept_name = session('dept_name');
        $pid = session('pid');
        $deptid = session('hr_sn');
        $status="N";//$request->status;

        return view('jobs.create', compact('num', 'user_name', 'dept_name', 'deptid', 'depts', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = Job::create($request->all());
        $count = Counter::Getcounter('job');
        $app_no=date("ymd")."-".str_pad($count, 3, "0",STR_PAD_LEFT);
        $pid = session('pid');
        Job::find($job->id)->update(['app_no'=> $app_no, 'req_pid' => $pid]);//, 'user_name' => $user_name
        //flash('新增成功');
        return redirect('jobs');
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
        $depts = Dept::orderBy('hr_sn')->pluck('dept_name','hr_sn');
        $num = Job::all()->count();
        $job = Job::ViewInfo('N')->where('jobs.id', $id)->first();
        //dd($job);
        $user_name = session('user_name');
        $dept_name = session('dept_name');
        $pid = session('pid');
        $status="N";//才能修改

        return view('jobs.edit', compact('job', 'num', 'user_name', 'dept_name', 'depts', 'status'));
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
        return redirect()->route('jobs.index')
                        ->with('success','修改成功');
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
        return redirect()->route('jobs.index')->with('success','刪除成功');
    }
    public function search(Request $request)
    {
        /*if (!session('user')) {
            return redirect('http://int.bolcc.tw');
        }*/

        $searchKey="";
        $deptid=0;
        //$status='A'; $orderSeq='desc';
        $status='N';
        $orderSeq='asc';
        $user_name = session('user_name');
        $dept_name = session('dept_name');
        $jobs = Job::ViewInfo($status)->orderBy('app_duedate', $orderSeq)->orderBy('app_no', $orderSeq)->paginate($this->pageLineCount);
        $num = Job::where('app_status', $status)->count();

        $depts= Dept::orderBy('hr_sn')->pluck('dept_name', 'hr_sn');

        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'deptid', 'depts', 'status'));//, 'status'
    }
    public function getsearch(Request $request)
    {
        $status=$request->status;
        //if ($status=='0') $status='N';
        $orderSeq='asc';
        if ($status != 'N') $orderSeq='desc';
        $deptid=$request->deptid;
        
        if ($request->searchKey) $searchKey=$request->searchKey;
        else $searchKey="";
            if ($deptid>0){
                $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)->where('app_deptid', $deptid)->orderBy('app_duedate', $orderSeq)->orderBy('app_no', $orderSeq)->get();//->paginate($this->pageLineCount);此處不能使用，第二頁會出錯
                $num = Job::SearchGroup($searchKey, $status)->where('app_deptid', $deptid)->count();
        
            }else{
                $jobs = Job::ViewInfo($status)->SearchGroup($searchKey, $status)->orderBy('app_duedate', $orderSeq)->orderBy('app_no', $orderSeq)->get();//->paginate($this->pageLineCount);此處不能使用，第二頁會出錯
                $num = Job::SearchGroup($searchKey, $status)->count();

            }
        //dd($request->deptid);
        $user_name = session('user_name');
        $dept_name = session('dept_name');
        $pid = session('pid');
        $depts= Dept::orderBy('hr_sn')->pluck('dept_name', 'hr_sn');

        return view('jobs.index', compact('jobs', 'num', 'user_name', 'dept_name', 'searchKey', 'deptid', 'depts', 'status', 'searchKey'));//
    }
    public function export(Request $request)
    {
        
        return \Excel::download(new Exports\JobsExport(), 'test.xls');

    }
}
