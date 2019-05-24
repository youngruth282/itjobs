<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myuser extends Model
{
    public function scopeCrews($query, $hr_sn)
    {
        return $query->where('hr_sn', $hr_sn)->get();

    }
  
}
