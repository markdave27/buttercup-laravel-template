<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $table = 'logs';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = array(
        'log_type_id', 'user_id', 'message', 'ip'
    );
}
