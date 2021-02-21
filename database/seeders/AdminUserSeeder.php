<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Administrator',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);

    }
}
