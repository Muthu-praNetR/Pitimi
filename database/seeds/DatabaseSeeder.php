<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * The DatabaseSeeder class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call(LocalesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TalksTableSeeder::class);

        Model::reguard();
    }
}
