<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndBaseController extends Controller
{
    //
    public function getHome()
    {
        return view('front.home');
    }
}
