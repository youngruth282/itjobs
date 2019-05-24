<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;
use App\Exports;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\RepositoryInterface
     */
    protected $postRepository;
 
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Show all post
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();
        return \Excel::download(new Exports\PostsExport($this->postRepository, 'Y'), 'invoices.xlsx');
        /*$excel = new \Excel($this->postRepository);
        $export = $this->postRepository->getAll();
        $this->export_final($excel, $export);*/
//        return view('home.post', compact('posts'));
    }
 
    /**
     * Show single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);
 
        return view('home.post', compact('post'));
    }
 
    /**
     * Create single post
     *
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
 
        //... Validation here
 
        $post = $this->postRepository->create($data);
 
        return view('home.post', compact('post'));
    }
 
    /**
     * Update single post
     *
     * @param $request \Illuminate\Http\Request
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
 
        //... Validation here
 
        $post = $this->postRepository->update($id, $data);
 
        return view('home.post', compact('post'));
    }
 
    /**
     * Delete single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return view('home.post');
    }
    public function export_(Request $request)
    {
        $name= 'view預算會計科目說明'.date("ymd").'.xlsx';
        return \Excel::download(new \Exports\PostsviewExport, $name);//best 
    }
    public function export(Request $request)
    {
        $deptid = session('hr_sn');
        $dept_name = session('dept_name');
        if ($request->status) $status=$request->status;
        else $status="A";//其實可以不用
        if ($request->searchKey) $searchKey=$request->searchKey;
        else $searchKey='';
        //        dd($searchKey);
        $crewid=$request->crewid;
        // $user_name = \App\Myuser::where('pid', $crewid)->select('user_name')->first();
        $fname = 'Jobs_'.$dept_name.date('Ymd').'.xlsx';
        //$posts = $this->postRepository->getAll();
        if ($crewid == -1){//個人
            $pid = session('pid');
            $searchArray = array('req_pid'=>$pid);//
            /* 若是將來連個人都要分 進行中/已完成則需要
            if ($status == 0) $searchArray = array('req_pid'=>$pid);
            else $searchArray = array('app_status'=> $status, 'req_pid'=>$pid);*/
        }else if ($crewid > 0 and $status != 'A'){//選擇狀態 - 選擇部門
            $searchArray = array('app_status'=> $status, 'req_pid'=>$crewid);
        }else if ($crewid == 0 and $status != 'A'){//選擇狀態 - 全部部門
            $searchArray = array('app_status'=> $status);
        }else if ($crewid > 0 and $status == 'A'){//全部狀態 - 選擇部門
            $searchArray = array('req_pid'=>$crewid);
        }else if ($crewid == 0 and $status == 'A'){//全部狀態 - 全部部門
            return \Excel::download(new Exports\PostsExport($this->postRepository, $searchKey), $fname);
        }
        
        return \Excel::download(new Exports\PostsExport($this->postRepository, $searchKey, $searchArray), $fname);

    }
    public function vexport()
    {
        $name= 'view.xlsx';
        return \Excel::download(new Exports\JobstestExport, $name);
    }
}