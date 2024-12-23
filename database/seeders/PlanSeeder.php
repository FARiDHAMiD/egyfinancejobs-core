<?php

namespace Database\Seeders;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'price' => 500,
            'title' => 'Bronze Package',
            'subtitle' => 'Best for start-ups with basic hiring needs',
            'employees_number' => 10,
            'jobs_number' => 1,
        ]);

        Plan::create([
            'price' => 1250,
            'title' => 'Silver Package',
            'subtitle' => 'Best for start-ups with basic hiring needs',
            'employees_number' => 30,
            'jobs_number' => 2,
        ]);
        Plan::create([
            'price' => 3325,
            'title' => 'Gold Package',
            'subtitle' => 'Best for start-ups with basic hiring needs',
            'employees_number' => 100,
            'jobs_number' => 5,
        ]);
    }
}
