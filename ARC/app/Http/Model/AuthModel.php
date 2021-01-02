<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    public    $timestamps     = false;
    protected $table       = 't_relay_login';
    protected $primaryKey  = 'p_id';
    protected $fillable    = [
        'p_id', 'emp_id', 'p_expire'
    ];
}
?>