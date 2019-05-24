<?php
namespace App\Repositories\Post;
 
use App\Repositories\EloquentRepository;
 
class PostEloquentRepository extends EloquentRepository implements PostRepositoryInterface
{
 
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Post::class;
    }
 
    /**
     * Get all posts only published
     * @return mixed
     */

    public function getSearchData($keyword, $searchArray)
    {
        if ($searchArray===NULL){
            if ($keyword){
                $result = $this->_model
                ->leftJoin('myusers', 'jobs.req_pid','myusers.pid')->leftJoin('depts', 'jobs.app_deptid','depts.hr_sn')
                /*->when($searchArray, function($query) use($searchArray){
                    $query->where($searchArray);
                })*/
                ->where('app_item', 'LIKE', '%' . $keyword . '%')->orWhere('app_content', 'LIKE', '%' . $keyword . '%')->orWhere('app_memo', 'LIKE', '%' . $keyword . '%')
                ->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')
                ->orderBy('jobs.app_duedate')
                ->get();
                //dd($result);
            }else{
                $result = $this->_model
                ->leftJoin('myusers', 'jobs.req_pid','myusers.pid')->leftJoin('depts', 'jobs.app_deptid','depts.hr_sn')
                /*->when($searchArray, function($query) use($searchArray){
                    $query->where($searchArray);
                })*/
                ->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')
                ->orderBy('jobs.app_duedate')
                ->get();
            }
        }else{
            if ($keyword){
                $result = $this->_model
                ->leftJoin('myusers', 'jobs.req_pid','myusers.pid')->leftJoin('depts', 'jobs.app_deptid','depts.hr_sn')
                /*->when($searchArray, function($query) use($searchArray){
                    $query->where($searchArray);
                })*/
                ->where($searchArray)
                ->where(function ($query) use ($keyword) {
                    $query->where('app_item', 'LIKE', '%' . $keyword . '%')->orWhere('app_content', 'LIKE', '%' . $keyword . '%')->orWhere('app_memo', 'LIKE', '%' . $keyword . '%');
                })
                ->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')
                ->orderBy('jobs.app_duedate')
                ->get();
            }else{
                $result = $this->_model
                ->leftJoin('myusers', 'jobs.req_pid','myusers.pid')->leftJoin('depts', 'jobs.app_deptid','depts.hr_sn')
                /*->when($searchArray, function($query) use($searchArray){
                    $query->where($searchArray);
                })*/
                ->where($searchArray)
                ->selectRaw('jobs.app_no, myusers.user_name, depts.dept_name, jobs.app_item, jobs.app_content,jobs.app_crewname, jobs.app_progress, jobs.app_duedate, jobs.app_memo')
                ->orderBy('jobs.app_duedate')
                ->get();
            }
        }
            //dd($result);
 
        return $result;
    }
}