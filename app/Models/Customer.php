<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'tblcustomers';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
