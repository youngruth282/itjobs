<?php
namespace App\Repositories;
 
interface RepositoryInterface
{
    /**
     * 得到所有
     * @return mixed
     */
    public function getAll();
 
    /**
     * 得到单个
     * @param $id
     * @return mixed
     */
    public function find($id);
 
    /**
     * 创建
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);
 
    /**
     * 更新
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);
 
    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public function delete($id);
}