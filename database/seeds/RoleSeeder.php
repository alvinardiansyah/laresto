<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'desc' => 'admin'
        ]);

        Role::create([
            'name' => 'Manager',
            'desc' => 'manager'
        ]);

        Role::create([
            'name' => 'Cashier',
            'desc' => 'cashier'
        ]);
    }
}
