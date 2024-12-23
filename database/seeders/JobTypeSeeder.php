<?php

namespace Database\Seeders;
use App\Models\JobType;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Full Time',
            'Part Time',
            'Internship',
            'Freelance / Project',
            'Work From Home',
            'Voulanteering',
            'Student Activity',
        ];
        foreach($data as $element){
            JobType::create([
                'name' => $element,
            ]);
        }
    }
}
