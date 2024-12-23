<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Seeder;

class Laratrust extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ "name" => 'admin', 'display_name' => 'Admin']);
        Role::create([ "name" => 'employer', 'display_name' => 'Employer']);
        Role::create([ "name" => 'employee', 'display_name' => 'Employee']);
    }
}
