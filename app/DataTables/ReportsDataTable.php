<?php

namespace App\DataTables;

use App\Models\User;
use DB;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
{
    private $database_table_dt;
    private $columns;
    protected $filename;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $records = DB::table($this->database_table_dt)->select($this->columns)->get();

        return datatables($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        #return $model->newQuery()->select('id', 'username', 'created_at', 'updated_at');
        return DB::table($this->database_table_dt)->select($this->columns);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->columns)
                    ->minifiedAjax()
                    ->addAction(['printable' => false])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
//        return [
//            'id',
//            'username',
//            'created_at',
//            'updated_at'
//        ];
        return $this->columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return $this->filename;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;
    }

    public function setTable($table)
    {
        $this->database_table_dt = $table;
    }

    public function getTable()
    {
        return $this->database_table_dt;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename . '_' . date('YmdHis');
    }
}
