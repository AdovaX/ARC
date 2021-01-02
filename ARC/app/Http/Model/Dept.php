<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    public $timestamps = false;
    protected $table = 'm_dept';
    protected $primaryKey = "dept_id";
    protected $casts = [
        'dept_id' => 'string',
        'dept_level' => 'integer'
    ];
    protected $fillable = ["dept_id","dept_name","dept_name_kana","nick_name","dept_level","is_profit","is_commitee","is_active","updated_at"];
}
