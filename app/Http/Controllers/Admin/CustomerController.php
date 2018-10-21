<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerController extends AdminBaseController
{
    private $columns = [
        'id' => 'ID',
        'strName' => 'Name',
        'strAddress' => 'Address',
//        'lngSuburb' => 'Suburb Longitude',
        'strPostalAddress' => 'Postal Address',
//        'lngPostalSuburb' => 'Postal Suburb Longitude',
//        'lngPostalPostcode' => 'Postal Postal Code Longitude',
        'strTelephone' => 'Telephone',
        'strMobile' => 'Mobile',
        'lngPostcode' => 'Postal Code Longitude',
//        'strGridNo' => 'Grid Number',
        'strDirections' => 'Directions',
        'ysnSourceYP' => 'Source YP',
        'ysnSourceBC' => 'Source BC',
        'ysnSourceM' => 'Source M',
        'ysnSourceCourier' => 'Source Courier',
        'strSourceOther' => 'Source Other',
        'memNotes' => 'Notes',
//        'ExcelID' => 'Excel ID',
        'strEmail' => 'Email',
        'Recall' => 'Recall',
        'LastCall' => 'Last Call',
        'DateCleaned' => 'Date Cleaned',
        'TankDetails' => 'Tank Details',
        'LastPrice' => 'Last Price',
        'strSuburb' => 'Suburb',
        'strPostalSuburb' => 'Postal Suburb',
        'strSurname' => 'Surname',
        'strTitle' => 'Title',
        'strPostcode' => 'Postal Code',
        'dtmCallAgain' => 'Call Again Date Time',
//        'LastCallStatusID' => 'Last Call Status ID',
        'dtmLastCalled' => 'Last Called Date Time',
//        'TitleID' => 'Title ID',
        'ts' => 'Timestamp',
        'altPhone' => 'Alternate Phone',
        'altMobile' => 'Alternate Mobile',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $columns = $this->columns;
        $column_keys = array_keys($columns);
        $js_columns = array();
        foreach($column_keys as $column){
            $js_columns[] = array('data' => $column, 'name' => $column);
        }
        $js_columns[] = array('data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false, 'class' => 'col-action');
        $js_columns = json_encode($js_columns);
        #$js_columns = str_replace('"', '\"', json_encode($js_columns));
        return view('admin.customers.customers', compact('columns', 'js_columns'));
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
        $records = Customer::select($columns);

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
