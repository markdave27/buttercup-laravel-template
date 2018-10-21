<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $table = 'user_types';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = array(
        'user_type'
    );

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_user_types_look_ups', 'user_type_id', 'user_id');
    }
}
