<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LogTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $log_types = array(
            'User',
            'User Type',
            'Log Type',
            'Customer Category',
        );

        foreach($log_types as $log_type){
            DB::table('log_types')->insert([
                'log_type' => $log_type,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
