<?php

namespace Database\Seeders;
use App\Models\User;


use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // admin creation
        $admin = User::create([
            "first_name" => 'Eslam', 
            'last_name' => 'soliman',
            'email' => 'super@admin.com',
            'password' => bcrypt('123123')
        ]);
        $admin->attachRole('admin');



    }
}
