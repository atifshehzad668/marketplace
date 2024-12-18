<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Aatif shehzad',
            'email' => 'aatifshehzad668@gmail.com',
            'password' => Hash::make('admin123'),
            'username' => 'aatif shehzad',

        ]);
        $user->assignRole('Super Admin');
    }
}