<?php

use App\Locale;
use Illuminate\Database\Seeder;

/**
 * The LocalesTableSeeder class.
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
        Locale::create(['code' => 'es', 'name' => 'Español']);
        Locale::create(['code' => 'ht', 'name' => 'Kreyòl Ayisyen']);
    }
}
