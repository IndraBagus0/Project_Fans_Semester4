<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Customer::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('12345'),
                'phone_number' => '1234567890',
                'status' => 'non active',
                'address' => '123 Main St, City',
                'subcribe_date' => null,
                'id_product' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'username' => 'janesmith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('12345'),
                'phone_number' => '9876543210',
                'status' => 'non active',
                'address' => '456 Elm St, City',
                'subcribe_date' => null,
                'id_product' => 2,
            ],
            [
                'name' => 'Michael Johnson',
                'username' => 'michaeljohnson',
                'email' => 'michaeljohnson@example.com',
                'password' => Hash::make('12345'),
                'phone_number' => '555555555',
                'status' => 'non active',
                'address' => '789 Road, City',
                'subcribe_date' => null,
                'id_product' => 3,
            ],
            [
                'name' => 'Sarah Davis',
                'username' => 'sarahdavis',
                'email' => 'sarahdavis@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '444444444',
                'status' => 'non active',
                'address' => '321 Lane, City',
                'subcribe_date' => null,
                'id_product' => 1,
            ],
            [
                'name' => 'Robert Wilson',
                'username' => 'robertwilson',
                'email' => 'robertwilson@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '777777777',
                'status' => 'non active',
                'address' => '987 Court, City',
                'subcribe_date' => null,
                'id_product' => 2,
            ],
        ];

        foreach ($data as $item) {
            Customer::create($item);
        }
    }
}
