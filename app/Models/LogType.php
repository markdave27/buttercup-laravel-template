<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogType extends Model
{
    //
    protected $table = 'log_types';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = array(
        'log_type'
    );
}
