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
        $user = new User();
        $user->first_name = 'Administrator';
        $user->last_name = 'Of All Admins';
        $user->email = 'admin';
        $user->password = Hash::make('password');
        $user->locale()->associate(Locale::where('code', 'en')->first());
        $user->save();

        DB::table('congregations')->delete();
        $congregation = factory(Congregation::class)->make();
        $congregation->created_by = $user->id;
        $congregation->updated_by = $user->id;
        $congregation->save();

        $user->congregations()->attach($congregation);
        $user->save();

    }
}
