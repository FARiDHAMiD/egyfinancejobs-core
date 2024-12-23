<?php

namespace Database\Seeders;
use App\Models\Experience;
use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_category_id = rand(1, 18); // Adjust this range to match actual IDs in job_titles

        for ($i=1; $i <= 100; $i++) {
            $job_titles = [ "Accountant", "Accounting Manager", "Financial Analyst", "Auditor", "Senior Accountant", "Tax Accountant", "Controller", "Accounting Clerk", "Bookkeeper", "Accounts Payable Clerk" ];
            $company_names = [ "Orascom Construction", "Gebel Elba Petroleum Holding Company", "El Sewedy Electric", "EFG Hermes", "Arab African International Bank", "Egyptian Gulf Bank", "Petrojet", "Qalaa Holdings", "Al Ahly Capital Holding", "Commercial International Bank (CIB)" ];
            if (JobCategory::find($job_category_id)) {

                Experience::create([
                    'employee_id' => rand(2,31),
                    'job_title' => $job_titles[rand(0,9)],
                    'company_name' => $company_names[rand(0,9)],
                    'job_category_id' => rand(1,14),
                    'company_industry_id' => rand(1,14),
                    'job_type_id' => rand(1,7),
                    'currently_work_there' => 0,
                    'starting_from' => '2020-06-15',
                    'ending_in' => '2022-11-23',
                ]);
            }
        }
    }
}
