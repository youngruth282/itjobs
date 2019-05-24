<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'jobs';
    protected $guarded = [];//'app_no', 'req_pid', 'user_name', 'deleted_at'];

}
