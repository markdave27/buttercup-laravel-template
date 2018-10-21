<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Models\LogType;
use App\Models\UserViewLog;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DataTables\ReportsDataTable;
use DB;
use Carbon\Carbon;

class LogController extends AdminBaseController
{
    private $columns = [
        'id' => 'ID',
        'message' => 'Message',
        'created_at' => 'Date Time',
        'ip' => 'IP',
        'log_type' => 'Log Type',
        'username' => 'Username',
    ];

    private $fields = [

    ];

    private $route_key = 'logs';
    private $page_name_singular = 'Log';
    private $page_name_plural = 'Logs';
    private $database_table_dt = 'uv_logs';
    private $database_table = 'uv_logs';
    private $unique_field = '';
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
        #return view('admin.logs.'.$this->route_key, compact('columns', 'js_columns', 'route_key', 'page_name'));
        return $dataTable
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
    }

    public function serverSide()
    {
        $columns = array_keys($this->columns);
        $records = UserViewLog::select($columns);

        return Datatables::of($records)
            ->escapeColumns($columns)
            ->make(true);
    }
}
