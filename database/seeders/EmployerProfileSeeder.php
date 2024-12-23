<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Area;
use App\Models\EmployerProfile;
use Illuminate\Database\Seeder;

class EmployerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) {

            $city_id = rand(1,10);
            $area_id = Area::where(['city_id' => $city_id])->inRandomOrder()->first()->id;
            $titles = [ "Chief Financial Officer (CFO)", "Financial Controller", "Senior Accountant", "Financial Analyst", "Business Analyst", "Accounting Manager", "Director of Finance", "Investment Analyst", "Treasury Analyst", "Tax Manager" ];
            $company_names = [ "Orascom Construction", "Gebel Elba Petroleum Holding Company", "El Sewedy Electric", "EFG Hermes", "Arab African International Bank", "Egyptian Gulf Bank", "Petrojet", "Qalaa Holdings", "Al Ahly Capital Holding", "Commercial International Bank (CIB)" ];
            $names = [ 'Ahmed', 'Ali', 'Amr', 'Amin', 'Ayman', 'Bassel', 'Emad', 'Essam', 'Fathy', 'Gamal', 'Hamed', 'Hazem', 'Hisham', 'Ibrahim', 'Karim', 'Khaled', 'Mahmoud', 'Mamdouh', 'Mohamed', 'Mostafa', 'Nader', 'Nasser', 'Osama', 'Rami', 'Said', 'Salah', 'Tarek', 'Wael', 'Yasser', 'Youssef' ];
            $company_sizes = ['1-10','11-100','101-1000','1000+'];
            $user = User::create([
                'first_name' => $names[rand(0,29)],
                'last_name' => $names[rand(0,29)],
                'email' => 'employer'.$i.'@finance.com',
                'password' => bcrypt('123123'),
            ]);
            $user->attachRole('employer');

            EmployerProfile::create([
                'employer_id' => $user->id,
                'title' => $titles[$i-1],
                'mobile_number' => '01012345666',
                'company_name' => $company_names[rand(0,9)],
                'company_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur accusantium aperiam, fuga, libero cupiditate ipsa tenetur reiciendis exercitationem eum doloribus accusamus aliquid numquam mollitia autem. Quam officia incidunt veniam voluptas!',
                'company_industry_id' => rand(1,14),
                'company_size' => $company_sizes[rand(0,3)],
                'country_id' => 1,
                'city_id' => $city_id,
                'area_id' => $area_id,
            ]);
        } 
    }
}
