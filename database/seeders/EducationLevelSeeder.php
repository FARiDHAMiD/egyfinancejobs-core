<?php

namespace Database\Seeders;
use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Bachelor's degree",
            "Master's degree",
            "Doctorate (PhD) degree",
            "Diploma",
            "Certificate",
            "Technical degree/diploma",
            "Professional degree (e.g., law, medicine, pharmacy)",
            "Higher technician diploma",
            "Preparatory school certificate (for secondary education)",
            "General secondary education certificate (for high school)",
        ];
        foreach($data as $element){
            EducationLevel::create([
                'name' => $element,
            ]);
        }
    }
}
