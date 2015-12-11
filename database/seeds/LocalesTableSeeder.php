<?php

use Illuminate\Database\Seeder;
use App\Locale;

/**
 * The LocalesTableSeeder class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('locales')->delete();
        Locale::create(['code' => 'en', 'name' => 'English']);
        Locale::create(['code' => 'es', 'name' => 'Spanish']);
        Locale::create(['code' => 'ht', 'name' => 'Haitian Creole']);
    }
}
