<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserType;
use App\Helpers\LogToDatabase;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

use DB;
use Carbon\Carbon;
use App\DataTables\ReportsDataTable;

class UserTypeController extends AdminBaseController
{
    private $columns = [
        'id' => 'ID',
        'user_type' => 'User Type'
    ];

    private $fields = [
        'user_type' => 'User Type'
    ];

    private $log_id = 2;
    private $route_key = 'user-types';
    private $page_name_singular = 'User Type';
    private $page_name_plural = 'User Types';
    private $database_table_dt = 'user_types';
    private $database_table = 'user_types';
    private $unique_field = 'user_type';
    private $page_name_breadcrumbs = null;

    public function getHTMLColumns(array $additionalColumns)
    {
        $table_columns = array_keys($this->columns);
        foreach($additionalColumns as $additionalColumn){
            array_push($table_columns, $additionalColumn);
        }
        return $table_columns;
    }

    public function __construct()
    {
        $this->page_name_breadcrumbs = $this->get_page_name($this->page_name_singular, $this->page_name_plural, false);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReportsDataTable $dataTable)
    {
        //
        $dataTable->setColumns(array_keys($this->columns));
        $dataTable->setTable($this->database_table_dt);
        $dataTable->setFilename($this->page_name_plural . ' Report');

        $route_key = $this->route_key;
        $page_name = $this->get_page_name($this->page_name_singular, $this->page_name_plural);
        #return view('admin.users.user-types', compact('columns', 'js_columns'));
        return $dataTable
            ->before(function (\Yajra\DataTables\DataTableAbstract $dataTable) {
                $records = DB::table($this->database_table_dt)->select(array_keys($this->columns))->get();

                return $dataTable->addColumn('action', function($records){
                    return '
                    <a href="'. route($this->route_key.'.edit', $records->id) .'" class="btn btn-primary edit-button"> Edit</a>
                    <button class="btn btn-danger delete-button" data-token="'. csrf_token() .'" rec_id="'.$records->id.'" value="'.$records->{$this->unique_field}.'"> Delete</button>
                ';
                });
            })
            ->withHtml(function(\Yajra\DataTables\Html\Builder $builder) {
                $builder->columns($this->getHTMLColumns(['action']));
            })
            ->render('admin.users.' . $this->route_key, compact('route_key', 'page_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.user-types-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->flash();

        $rules = [
            'user_type' => [
                'required',
                'max:255',
                'unique:user_types,user_type'
                #Rule::unique('user_types')
            ]
        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route('user-types.create')->withErrors($validator);
        } else {
            //Store to database
            UserType::create($request->all());

            LogToDatabase::log(2, $request->user_type . ' - user type successfully added');

            return redirect()->route('user-types.create')->with('success',$request->user_type . ' user type created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user_type = UserType::findOrFail($id);

        return view('admin.users.user-types-edit', compact('user_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->flash();

        $fields = [
            'user_type' => 'User Type'
        ];

        $rules = [
            'user_type' => [
                'required',
                'max:255',
                'unique:user_types,user_type,'.$id.',id'
                #Rule::unique('user_types')->ignore($id)
            ]
        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route('user-types.edit', $id)->withErrors($validator);
        } else {
            //Update record
            UserType::find($id)->update($request->all());

            LogToDatabase::log(2, 'User type ID ' . $id . ' successfully updated to ' . $request->user_type);

            return redirect()->route('user-types.edit', $id)->with('success','User type successfully updated to ' . $request->user_type);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user_type = UserType::findOrFail($id);
        $user_type->delete();
        LogToDatabase::log(2, $user_type->user_type . ' deleted.');

        return response()->json($user_type);
    }

    public function serverSide()
    {
        $columns = array_keys($this->columns);
        $records = UserType::select($columns);

        return Datatables::of($records)
            ->escapeColumns($columns)
            ->addColumn('action', function($records) {
                return '
                            <a href="'. route('user-types.edit', $records->id) .'" class="btn btn-primary edit-button"> Edit</a>
                            <button class="btn btn-danger delete-button" data-token="'. csrf_token() .'" rec_id="'.$records->id.'" value="'.$records->user_type.'"> Delete</button>
                            ';
            })
            ->make(true);
    }
}
