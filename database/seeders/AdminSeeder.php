<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'contact_number' => '09123456789',
            'email' => 'admin@admin.com',
            'password' => Hash::make('superadmin'),
            'is_admin' => true,
        ]);
    }
}
