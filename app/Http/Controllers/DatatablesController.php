<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;

use App\Models\User;

class DatatablesController extends Controller
{
    //
    public function index()
    {
        return view('admin_template');
    }

    public function serverSide()
    {
        $columns = ['id', 'name', 'email', 'created_at', 'updated_at' ];

        $records = User::select($columns)->orderBy('id', 'desc');

        return Datatables::of($records)
            ->escapeColumns($columns)
            ->addColumn('action', function($records) {
                return '
                    <a href="'. route('datatables.edit', $records->id) .'" class="btn btn-primary edit-button"> Edit</a>
                    <button class="btn btn-danger delete-button" data-token="'. csrf_token() .'" rec_id="'.$records->id.'" value="'.$records->name.'"> Delete</button>
                    ';
            })
            ->make(true);
    }
}
