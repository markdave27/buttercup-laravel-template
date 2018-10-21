<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    //
    protected $table = 'customer_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = array(
        'customer_category', 'description'
    );
}
