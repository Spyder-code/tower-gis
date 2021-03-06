<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad aziz almi',
            'email' => 'admin@yahoo.com',
            'password' => Hash::make('admin123'),
            'role' => 'Super Admin'
        ]);
        User::create([
            'name' => 'Luay syauqillah',
            'email' => 'luay@yahoo.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);
    }
}
