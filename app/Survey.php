<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $connection="mysql_bolint";

    protected $table="surveys";

    protected $guarded = [];
}
