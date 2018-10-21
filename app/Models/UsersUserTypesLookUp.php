<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersUserTypesLookUp extends Model
{
    //
    protected $table = 'users_user_types_look_ups';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = array(
        'user_id',
        'user_type_id',
    );
}
