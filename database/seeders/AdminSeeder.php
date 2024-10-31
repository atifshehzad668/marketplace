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
            'name' => 'Atif Shehzad',
            'email' => 'aatifshehzad668@gmail.com',
            'password' => Hash::make('aatifshehzad668@gmail.com'),
            'username' => 'atif.shehzad',
            'points_balance' => 0,
        ]);
        $user->assignRole('Super Admin');
    }
}