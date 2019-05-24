<?php
namespace App\Repositories\Mission7;
 
use App\Repositories\EloquentRepository;
 
class Mission7EloquentRepository extends EloquentRepository implements Mission7RepositoryInterface
{
 
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\MmAmount::class;
    }
 
    /**
     * Get all posts only published
     * @return mixed
     */

    public function getData($orderby)
    {
        $result = $this->_model
        ->selectRaw('area_name, cell_name, sogi, value1, value2, value3, value4, created_at')
        ->orderBy($orderby)
        ->get();
        //dd($result);
 
        return $result;
    }
}