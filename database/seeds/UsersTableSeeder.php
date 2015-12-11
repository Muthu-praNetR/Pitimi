<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Locale;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = new User();
        $user->first_name = 'Administrator';
        $user->last_name = 'Of All Admins';
        $user->email = 'admin';
        $user->password = Hash::make('password');
        $user->locale()->associate(Locale::where('code', 'en')->first());
        $user->save();
    }
}
