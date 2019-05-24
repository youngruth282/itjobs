<?php
namespace App\Repositories\Mission7;
 
interface Mission7RepositoryInterface
{
    /**
     * 得到s的文章
     * @return mixed
     */

    public function getData($orderby);
    
}