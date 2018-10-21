<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    //
    public function getValidationMessages($fields)
    {
        $messages = array();
        foreach($fields as $field => $name){
            $messages[$field . '.email'] = $name . ' must be a valid E-mail address';
            $messages[$field . '.required'] = $name . ' field is required';
            $messages[$field . '.max'] = $name . ' field max character or value is :max';
            $messages[$field . '.min'] = $name . ' field min character or value is :min';
            $messages[$field . '.unique'] = $name . ' already existing';
            $messages[$field . '.unique_with'] = $name . ' combination already existing';
            $messages[$field . '.confirmed'] = $name . ' must match with the confirmation field value';
            $messages[$field . '.integer'] = $name . ' must be a valid integer value';
            $messages[$field . '.date'] = $name . ' must be a valid date value';
            $messages[$field . '.before'] = $name . ' must be before the date today';
            $messages[$field . '.regex'] = $name . ' must match a certain pattern';
            $messages[$field . '.mimes'] = $name . ' must be with the following extension: :mimes';
        }
        return $messages;
    }

    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getBlank()
    {
        return view('admin.blank');
    }

    public function get_page_name($singular_form, $plural_form, $get_singular = true)
    {
        if($get_singular){
            return $singular_form;
        } else {
            return $plural_form;
        }
    }
}
