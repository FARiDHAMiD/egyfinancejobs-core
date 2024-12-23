<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Area;
use App\Models\EmployeeProfile;
use App\Models\JobCategory;
use App\Models\JobTitle;
use Illuminate\Database\Seeder;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 30; $i++) {
            $uniqueEmail = 'employee' . uniqid() . '@finance.com';

            $city_id = rand(1,10);
            $area_id = Area::where(['city_id' => $city_id])->inRandomOrder()->first()->id;
            $marital_status = [ 'single' , 'married' , 'divorced' , 'widowed'];
            $military_status = ['exempted', 'completed', 'postponed', 'not applicable'];
            $names = [ 'Ahmed', 'Ali', 'Amr', 'Amin', 'Ayman', 'Bassel', 'Emad', 'Essam', 'Fathy', 'Gamal', 'Hamed', 'Hazem', 'Hisham', 'Ibrahim', 'Karim', 'Khaled', 'Mahmoud', 'Mamdouh', 'Mohamed', 'Mostafa', 'Nader', 'Nasser', 'Osama', 'Rami', 'Said', 'Salah', 'Tarek', 'Wael', 'Yasser', 'Youssef' ];

            $user = User::create([
                'first_name' => $names[rand(0,29)],
                'last_name' => $names[rand(0,29)],
                'email' => $uniqueEmail,
                'email_verified_at' => '2024-11-15 06:10:58',
                'password' => bcrypt('123123'),
            ]);
            $user->attachRole('employee');

            $user->job_types()->attach(rand(1,3), ['created_at' => now(), 'updated_at' => now()]);
            $user->job_types()->attach(rand(4,7), ['created_at' => now(), 'updated_at' => now()]);

            $jobCategoryId1 = rand(1,6);
            $jobCategoryId2 = rand(7,13);

            if (JobCategory::find($jobCategoryId1)) {
                $user->job_categories()->attach($jobCategoryId1, ['created_at' => now(), 'updated_at' => now()]);
            }

            if (JobCategory::find($jobCategoryId2)) {
                $user->job_categories()->attach($jobCategoryId2, ['created_at' => now(), 'updated_at' => now()]);
            }

            // $user->job_categories()->attach(rand(1,6), ['created_at' => now(), 'updated_at' => now()]);
            // $user->job_categories()->attach(rand(7,13), ['created_at' => now(), 'updated_at' => now()]);
            $job_title_id = rand(1, 18); // Adjust this range to match actual IDs in job_titles
            if (JobTitle::find($job_title_id)) {

                EmployeeProfile::create([
                    'employee_id' => $user->id,
                    'career_level_id' => rand(1,5),
                    'accepted_salary' => rand(1,9)*1000,
                    'show_salary' => rand(0,1),
                    'searchable' => rand(0,1),
                    'job_title_id' => $job_title_id,
                    'profile_public' => rand(0,1),
                    'birthdate' => '1997-06-22',
                    'gender' => 'male',
                    'country_id' => 1,
                    'city_id' => $city_id,
                    'area_id' => $area_id,
                    'phone' => '01012345666',
                    'marital_status' => $marital_status[rand(0,3)],
                    'military_status' => $military_status[rand(0,3)],
                ]);
            }
        }
    }
}
