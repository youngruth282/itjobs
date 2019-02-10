<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $guarded = [];
    public function scopeGetcounter($query, $classname)
    {
        $data = $query->where(['name'=> $classname, 'udate'=> date("Y-m-d")])->first();
        if ($data){
            $cnt=$data['count']+1;
            // $this->where('id',$data['id'])->update(['count' => $cnt]);
            $id=$data['id'];
            $this->find($id)->increment('count');
            return $cnt;
        }
        $this->insert(['name'=> $classname, 'udate'=> date("Y-m-d"), 'count' => 1]);
        return 1;
    }
}
