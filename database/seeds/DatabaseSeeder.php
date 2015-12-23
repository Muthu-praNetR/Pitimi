<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
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
        $this->call(AdminSeeder::class);
        $this->call(TalksTableSeeder::class);

        Model::reguard();
    }
}
