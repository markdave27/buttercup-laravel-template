<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Helpers\LogToDatabase;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\DataTables\ReportsDataTable;

class LogTypeController extends AdminBaseController
{
    private $columns = [
        'id' => 'ID',
        'log_type' => 'Log Type'
    ];

    private $fields = [
        'log_type' => 'Log Type'
    ];

    private $log_id = 3;
    private $route_key = 'log-types';
    private $page_name_singular = 'Log Type';
    private $page_name_plural = 'Log Types';
    private $database_table_dt = 'log_types';
    private $database_table = 'log_types';
    private $unique_field = 'log_type';
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

    public function checkDropDownOptions()
    {

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
        #return view('admin.logs.'.$this->route_key, compact('columns', 'js_columns', 'route_key', 'page_name'));
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
            ->render('admin.logs.' .  $this->route_key, compact('route_key', 'page_name'))
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
        $route_key = $this->route_key;
        $page_name = 'Add ' . $this->get_page_name($this->page_name_singular, $this->page_name_plural);
        $page_name_breadcrumbs = $this->page_name_breadcrumbs;
        return view('admin.logs.'.$this->route_key.'-create', compact('page_name', 'route_key', 'page_name_breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $rules = [
            'log_type' => [
                'required',
                'max:255',
                'unique:log_types,log_type'
                #Rule::unique('log_types')
            ]
        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route($this->route_key.'.create')->withErrors($validator);
        } else {
            //Store to database
            $arr_request = $request->except('_token');
            $arr_request['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $arr_request['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table($this->database_table)->insert($arr_request);

            $message = $arr_request[$this->unique_field] . ' - '.$this->get_page_name($this->page_name_singular, $this->page_name_plural).' record successfully created';
            LogToDatabase::log($this->log_id, $message);

            return redirect()->route('log-types.create')->with('success',$request->log_type . ' log type created successfully.');
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
        //Show edit page
        $route_key = $this->route_key;
        $page_name = 'Edit ' . $this->get_page_name($this->page_name_singular, $this->page_name_plural);
        $page_name_breadcrumbs = $this->page_name_breadcrumbs;
        $record = DB::table($this->database_table)
            ->where('id', $id)
            ->get()
            ->first();
        return view('admin.logs.'.$this->route_key.'-edit', compact('record', 'route_key', 'page_name', 'page_name_breadcrumbs'));
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

        $rules = [
            'log_type' => [
                'required',
                'max:255',
                'unique:log_types,log_type,'.$id.',id'
            ]
        ];

        $messages = $this->getValidationMessages($this->fields);

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->route($this->route_key.'.edit', $id)->withErrors($validator);
        } else {
            //Update record
            $arr_request = $request->except(['_token', '_method']);
            $arr_request['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table($this->database_table)
                ->where('id', $id)
                ->update($arr_request);
            $message = $arr_request[$this->unique_field] . ' - '.$this->get_page_name($this->page_name_singular, $this->page_name_plural).' record successfully updated';
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
        //
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
