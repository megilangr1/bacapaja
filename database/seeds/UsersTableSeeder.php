<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => 1,
            'name' => 'M Gilang R',
            'email' => 'megilangr1@mail.com',
            'password' => bcrypt('megilangr1')
        ]);

        $user->assignRole('Admin');
    }
}
