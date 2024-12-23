<?php

namespace Database\Seeders;
use App\Models\CareerLevel;
use Illuminate\Database\Seeder;

class CareerLevelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Student',
            'Entry Level',
            'Experienced',
            'Manager',
            'Senior Management',
        ];
        foreach($data as $element){
            CareerLevel::create([
                'name' => $element,
            ]);
        }
    }
}
