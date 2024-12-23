<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        function generateNumberList($max) { $result = array(); $num = rand(1, $max);  while (count($result) < $num) { $randNum = rand(1, $max); if (!in_array($randNum, $result)) { $result[] = $randNum; } } return $result; }
        $this->call(Laratrust::class);
        $this->call(UsersSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(CareerLevelSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(JobTitleSeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(EducationLevelSeeder::class);
        $this->call(EmployeeProfileSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(EmployeeSkillSeeder::class);
        $this->call(EmployeeAchievementSeeder::class);
        $this->call(EmployerProfileSeeder::class);
        $this->call(SocialLinkSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(PlanRequestSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(JobQuestionSeeder::class);
        $this->call(JobApplicationSeeder::class);
        $this->call(JobApplicationAnswerSeeder::class);
        $this->call(WebsiteSettingSeeder::class);
    }
}
