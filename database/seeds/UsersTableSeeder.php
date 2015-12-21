<?php

use App\Congregation;
use App\Locale;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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

        $user = new User();
        $user->first_name = 'User';
        $user->last_name = 'Of All Users';
        $user->email = 'user';
        $user->password = Hash::make('password');
        $user->is_admin = false;
        $user->locale()->associate(Locale::where('code', 'en')->first());
        $user->save();

        DB::table('congregations')->delete();
        $congregation = factory(Congregation::class)->make();
        $congregation->created_by = $admin->id;
        $congregation->updated_by = $admin->id;
        $congregation->save();

        $admin->congregations()->attach($congregation);
        $admin->save();

        $user->congregations()->attach($congregation);
        $user->save();

    }
}
