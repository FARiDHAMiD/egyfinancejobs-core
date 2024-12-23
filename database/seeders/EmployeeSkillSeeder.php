<?php

namespace Database\Seeders;
use App\Models\EmployeeSkill;
use Illuminate\Database\Seeder;

class EmployeeSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(1,2),
                'skill_level' => rand(1,5),
            ]);
        }
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(3,4),
                'skill_level' => rand(1,5),
            ]);
        }
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(5,7),
                'skill_level' => rand(1,5),
            ]);
        }
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(8,9),
                'skill_level' => rand(1,5),
            ]);
        }


        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(10,12),
                'skill_level' => rand(1,5),
            ]);
        }
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(13,15),
                'skill_level' => rand(1,5),
            ]);
        }

        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(16,19),
                'skill_level' => rand(1,5),
            ]);
        }
        for ($i=2; $i <= 31; $i++) {
            EmployeeSkill::create([
                'employee_id' => $i,
                'skill_id' => rand(19,23),
                'skill_level' => rand(1,5),
            ]);
        }
    }
}
