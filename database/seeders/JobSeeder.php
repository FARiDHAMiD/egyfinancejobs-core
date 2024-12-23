<?php

namespace Database\Seeders;
use App\Models\Job;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\PlanRequest;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_titles = [ 'Financial Controller', 'Order Specialist', 'Senior Accountant', 'Data Analyst', 'General Accountant', 'Accounts Payable Accountant', 'Project Manager', 'Chef', 'Treasury Accountant', 'Salesperson', 'Tax Accounting Manager', 'Speaker', 'Accounts Receivable Accountant', 'Financial Analyst', 'Accountant', 'Administrative Assistant', 'Account Manager', 'Customer Service Representative', ];
        

        for ($i=1; $i <= 30; $i++) {
            $country_id = Country::find(1)->id;
            $city_id = City::where('country_id',$country_id)->inRandomOrder()->first()->id;
            $area_id = Area::where('city_id',$city_id)->inRandomOrder()->first()->id;
            $employer_id = rand(32,41);
            $employer_plan = PlanRequest::where('employer_id' , $employer_id)->get()[0];

            if($employer_plan->used_jobs < $employer_plan->total_jobs){
                $job = Job::create([
                    'employer_id' => $employer_id,
                    'job_title' => $jobs_titles[rand(0,17)],
                    'country_id' => $country_id,
                    'city_id' => $city_id,
                    'area_id' => $area_id,
                    'years_experience' => rand(1,5),
                    'category_id' => rand(1,11),
                    'education_level_id' => rand(1,10),
                    'type_id' => rand(1,7),
                    'career_level_id' => rand(1,5),
                    'salary' => rand(1,10)*1000,
                    'job_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!' ,
                    'job_excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!',
                    'job_requirements' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!',
                ]);
                
                foreach(generateNumberList(15) as $id){
                    $job->skills()->attach($id, ['created_at' => now(), 'updated_at' => now()]);
                }

                



                PlanRequest::where('employer_id' , $employer_id)->update(['used_jobs' => $employer_plan->used_jobs + 1]);
                if($employer_plan->total_jobs - $employer_plan->used_jobs == 1){
                    PlanRequest::where('employer_id' , $employer_id)->update(['status' => 'consumed']);
                }
            }else{
                PlanRequest::where('employer_id' , $employer_id)->update(['status' => 'consumed']);
            }
        }



        for ($i=1; $i <= 30; $i++) {
            $country_id = 1;
            $city_id = City::where('country_id',$country_id)->inRandomOrder()->first()->id;
            $area_id = Area::where('city_id',$city_id)->inRandomOrder()->first()->id;
            $employer_id = rand(32,41);
            $employer_plan = PlanRequest::where('employer_id' , $employer_id)->get()[0];

            if($employer_plan->used_jobs < $employer_plan->total_jobs){
                $job = Job::create([
                    'employer_id' => $employer_id,
                    'job_title' => $jobs_titles[rand(0,17)],
                    'country_id' => $country_id,
                    'city_id' => $city_id,
                    'area_id' => $area_id,
                    'years_experience' => rand(1,5),
                    'category_id' => rand(1,11),
                    'education_level_id' => rand(1,10),
                    'type_id' => rand(1,7),
                    'career_level_id' => rand(1,5),
                    'salary' => rand(1,10)*1000,
                    'job_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!' ,
                    'job_excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!',
                    'job_requirements' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam vitae corporis dicta doloribus deleniti impedit exercitationem dolor voluptates? Natus nihil voluptatem sequi earum eius error mollitia, neque nemo temporibus facere!',
                ]);
                foreach(generateNumberList(15) as $id){
                    $job->skills()->attach($id, ['created_at' => now(), 'updated_at' => now()]);
                }

                PlanRequest::where('employer_id' , $employer_id)->update(['used_jobs' => $employer_plan->used_jobs + 1]);
                if($employer_plan->total_jobs - $employer_plan->used_jobs == 1){
                    PlanRequest::where('employer_id' , $employer_id)->update(['status' => 'consumed']);
                }
            }else{
                PlanRequest::where('employer_id' , $employer_id)->update(['status' => 'consumed']);
            }
        } 

    }
}
