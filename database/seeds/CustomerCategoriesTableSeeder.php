<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CustomerCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $table = 'customer_categories';

        $records = array(
           [
                'customer_category' => 'Level 1',
                'description' => 'Level 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],
            [
                'customer_category' => 'Level 2',
                'description' => 'Level 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'customer_category' => 'Level 3',
                'description' => 'Level 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'customer_category' => 'Level 4',
                'description' => 'Level 4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );

        foreach($records as $record){
            DB::table($table)->insert([$record]);
        }
    }
}
