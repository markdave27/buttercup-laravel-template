<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_types = array(
            'Administrator',
            'User',
        );

        foreach($user_types as $user_type){
            DB::table('user_types')->insert([
                'user_type' => $user_type,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
