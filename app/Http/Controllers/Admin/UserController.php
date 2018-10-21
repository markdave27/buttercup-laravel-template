<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserType;
use App\Models\User;
use App\Helpers\LogToDatabase;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use DB;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use App\DataTables\ReportsDataTable;

class UserController extends AdminBaseController
{
    private $columns = [
        'id' => 'ID',
        'given_name' => 'Given Name',
        'surname' => 'Surname',
        'username' => 'Username',
        'email' => 'Email',
    ];

    private $fields = [
        'given_name' => 'Given Name',
        'surname' => 'Surname',
        'username' => 'Username',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'email' => 'Email',
    ];

    private $log_id = 1;
    private $route_key = 'users';
    private $page_name_singular = 'User';
    private $page_name_plural = 'Users';
    private $database_table_dt = 'users';
    private $database_table = 'users';
    private $unique_field = 'username';
    private $page_name_breadcrumbs = null;

    private $user_types = array();

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

    public function checkDropDownOptions()
    {
        $user_types_records = UserType::all();
        if(count($user_types_records) == 0){
            $error = array();
            $error[] = 'Can not add user for no existing user type is detected. Please add some user types first.';
            redirect()->route('user-types.create')->send()->withErrors($error);
        } else {
            foreach($user_types_records as $user_types_record){
                $this->user_types[$user_types_record->id] = $user_types_record->user_type;
            }
        }
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
        #return view('admin.' . $this->route_key . '.' . $this->route_key, compact('columns', 'js_columns', 'route_key', 'page_name'));
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
            ->render('admin.' . $this->route_key . '.' . $this->route_key, compact('route_key', 'page_name'))
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->checkDropDownOptions();

        $user_types = $this->user_types;

        $route_key = $this->route_key;
        $page_name = 'Add ' . $this->get_page_name($this->page_name_singular, $this->page_name_plural);
        $page_name_breadcrumbs = $this->page_name_breadcrumbs;

        return view('admin.' . $this->route_key . '.' . $this->route_key . '-create', compact('page_name', 'route_key', 'page_name_breadcrumbs', 'user_types'));
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
            'given_name' => [
                'required',
                'max:255'
            ],
            'surname' => [
                'required',
                'max:255'
            ],
            'username' => [
                'required',
                'max:255',
                'unique:users,username'
            ],
            'password' => [
                'required',
                'max:255',
                'min:6',
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
                'max:255',
                'min:6',
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users,email'
            ],
            'user_type_id' => [
                'required'
            ]

        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route($this->route_key.'.create')->withErrors($validator);
        } else {
            #dd($request);
            //Store to database
            $arr_request = $request->except('_token');
            $arr_request['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $arr_request['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $id = DB::table($this->database_table)->insertGetId($arr_request);
            #dd($id);

            $user = User::where('id', $id)->first();

            foreach($request->user_type_id as $user_type_id){
                $user->userTypes()->attach(UserType::where('id', $user_type_id)->first());
            }

            $message = $request->username . ' - User record successfully added';
            LogToDatabase::log($this->log_id, $message);

            return redirect()->route($this->route_key.'.create')->with('success',$message);
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
        $this->checkDropDownOptions();

        $user_types = $this->user_types;

        $roles = array();
        $role_recs = User::find($id)->userTypes;
        foreach($role_recs as $role_rec){
            $roles[$role_rec->id] = 1;
        }

        $route_key = $this->route_key;
        $page_name = 'Edit ' . $this->get_page_name($this->page_name_singular, $this->page_name_plural);
        $page_name_breadcrumbs = $this->page_name_breadcrumbs;

        $record = DB::table($this->database_table)
            ->where('id', $id)
            ->get()
            ->first();
        return view('admin.' . $this->route_key . '.' . $this->route_key . '-edit', compact('record', 'route_key', 'page_name', 'page_name_breadcrumbs', 'user_types', 'roles'));
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
        //
        $request->flash();

        $rules = [
            'given_name' => [
                'required',
                'max:255'
            ],
            'surname' => [
                'required',
                'max:255'
            ],
            'username' => [
                'required',
                'max:255',
                'unique:users,username,'.$id.',id'
            ],
            'password' => [
                'required',
                'max:255',
                'min:6',
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
                'max:255',
                'min:6',
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users,email,'.$id.',id'
            ],
            'user_type_id' => [
                'required'
            ]

        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route($this->route_key.'.edit', $id)->withErrors($validator);
        } else {
            $arr_request = $request->except(['_token', '_method', 'user_type_id', 'password_confirmation']);

            $arr_request['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table($this->database_table)
                ->where('id', $id)
                ->update($arr_request);

            $user = User::find($id);
            $user->userTypes()->detach();
            $user = User::where('id', $id)->first();
            foreach($request->user_type_id as $user_type_id){
                $user->userTypes()->attach(UserType::where('id', $user_type_id)->first());
            }

            $message = $arr_request[$this->unique_field] . ' - ' . $this->get_page_name($this->page_name_singular, $this->page_name_plural) . ' record successfully updated';
            LogToDatabase::log($this->log_id, $message);

            return redirect()->route($this->route_key.'.edit', $id)->with('success',$message);
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
        //Delete child records
        DB::table('users_user_types_look_ups')->where('user_id', $id)->delete();

        //DB::setFetchMode(\PDO::FETCH_ASSOC);
        $record = DB::table($this->database_table)
            ->select($this->unique_field)
            ->where('id', $id)
            ->first();
        $result = DB::table($this->database_table)->where('id', $id)->delete();
        LogToDatabase::log($this->log_id, $record->{$this->unique_field} . ' deleted.');
        return response()->json($result);
    }
}
