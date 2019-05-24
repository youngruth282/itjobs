<?php
// view_reg_yoyo
// select A.tran_name, B.tran_begin, B.tran_end, B.tran_time, B.tran_room, C.y_id, D.per_name, D.per_sex, D.per_mobil, D.per_email, D.team_no, D.team_name from equip.eqClassN A, equip.eqClassO B, equip.reg_yoyo C, member.per_area_team D where A.tran_id=B.tran_id and B.tran_cid=C.y_tran_cid and C.y_pid=D.pid and C.y_status='M' order by C.y_tran_cid,C.y_ts
namespace App;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{//目前未使用
    protected $connection="pgsql";

    protected $table="app.req_newmem";

    protected $guarded = [];

}
