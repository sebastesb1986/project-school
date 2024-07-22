<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $data = [

            [
                'name' => 'admin',
                'email' => 'admin2024@gmail.com',
                'phone' => '3003118989',
                'password' => bcrypt('admin1234')
            ],

        ];

        $user->insert($data);
    }
}
