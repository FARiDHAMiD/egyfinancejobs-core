<?php

namespace Database\Seeders;
use App\Models\PlanRequest;
use App\Models\Plan;
use App\Models\Employer;
use App\Models\Jobs;
use Illuminate\Database\Seeder;

class PlanRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=32; $i <= 41; $i++) {
            $plan = Plan::where('id', rand(1,3))->get()[0];
            PlanRequest::create([
                'employer_id' => $i,
                'plan_id' => $plan->id,
                'status' => 'approved',
                'total_employees' => $plan->employees_number,
                'used_employees' => 0,
                'total_jobs' => $plan->jobs_number,
                'used_jobs' => 0,
            ]);
        } 
    }
}
