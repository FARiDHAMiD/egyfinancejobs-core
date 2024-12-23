<?php

namespace Database\Seeders;
use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degree_names = [
            'Accounting',
            'Finance',
            'Business Administration',
            'Computer Science',
            'Statistics',
            'Mathematics',
            'Economics',
        ];

        for ($i=1; $i <= 100; $i++) {
            $timestamp = rand(strtotime('2015-01-01'), strtotime('2022-12-31'));
            $random_date = date('Y-m-d', $timestamp);

            Education::create([
                'employee_id' => rand(2,31),
                'education_level_id' => rand(1,10),
                'degree_details' => $degree_names[rand(0,6)],
                'university_id' => rand(1,26),
                'degree_date' => $random_date,
                'grade' => degree_grades()[rand(0,4)],
            ]);
        } 
    }
}
