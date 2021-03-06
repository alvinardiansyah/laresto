<?php

use Illuminate\Database\Seeder;

use App\User;

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
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@laresto.com',
            'password' => bcrypt('password')
        ]);
    }
}
