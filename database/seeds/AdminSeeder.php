<?php

use App\Locale;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class AdminSeeder
 */
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin = new User();
        $admin->first_name = 'Administrator';
        $admin->last_name = 'Of All Admins';
        $admin->email = 'admin';
        $admin->password = Hash::make('password');
        $admin->is_admin = true;
        $admin->locale()->associate(Locale::where('code', 'en')->first());
        $admin->save();
    }
}
