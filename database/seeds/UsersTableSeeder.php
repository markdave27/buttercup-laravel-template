<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserType;

use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_type_admin = UserType::where('user_type', 'Administrator')->first();
        $user_type_user = UserType::where('user_type', 'User')->first();

        $admin = new User();
        $admin->username = 'admin';
        $admin->given_name = 'Mark Dave';
        $admin->surname = 'Alonzo';
        $admin->password = bcrypt('admin123');
        $admin->email = 'admin@gmail.com';
        $admin->activated = '1';
        $admin->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $admin->save();
        $admin->userTypes()->attach($user_type_admin);

        $user = new User();
        $user->username = 'user';
        $user->given_name = 'Mark Dave';
        $user->surname = 'Alonzo';
        $user->password = bcrypt('user123');
        $user->email = 'user@gmail.com';
        $user->activated = '1';
        $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();
        $user->userTypes()->attach($user_type_user);
    }
}
