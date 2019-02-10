<?php
namespace App\Repositories\Post;
 
interface PostRepositoryInterface
{
    /**
     * 得到s的文章
     * @return mixed
     */

    public function getSearchData($keyword, $data);
    
}