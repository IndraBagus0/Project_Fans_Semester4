<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Indra Bagus',
                'username' => 'indra',
                'email' => 'indra@email.com',
                'password' => bcrypt('12345'),
                'roles' => 1,
                'address' => 'bondowoso'
            ]
        );
    }
}
