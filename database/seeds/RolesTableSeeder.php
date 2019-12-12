<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => 'Admin',
            'guard_name' => 'web'
        ],[
            'id' => 2,
            'name' => 'User',
            'guard_name' => 'web'
        ], [
            'id' => 3,
            'name' => 'Guest',
            'guard_name' => 'web'
        ]);
    }
}
