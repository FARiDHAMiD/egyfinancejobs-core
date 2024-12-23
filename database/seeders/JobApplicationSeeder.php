<?php

namespace Database\Seeders;
use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_count = Job::all()->count();

        for ($i=2; $i <= 31; $i++) {
            $count = rand(1,10);
            for ($x=1; $x <= $count; $x++) {
                JobApplication::create([
                    'employee_id' => $i,
                    'job_id' => rand(1,$jobs_count),
                    'status' => 'pending',
                ]);
            } 
        } 
    }
}
