<?php

namespace Database\Seeders;
use App\Models\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            'Ain Shams University',
            'Al-Azhar University',
            'Alexandria University',
            'Assiut University',
            'Aswan University',
            'Banha University',
            'Beni-Suef University',
            'Cairo University',
            'Damanhour University',
            'Damietta University',
            'Egypt-Japan University of Science and Technology',
            'Fayoum University',
            'Helwan University',
            'Kafrelsheikh University',
            'Mansoura University',
            'Minia University',
            'Minufiya University',
            'Port Said University',
            'Sadat Academy for Management Sciences',
            'Sohag University',
            'South Valley University',
            'Suez Canal University',
            'Suez University',
            'Tanta University',
            'University of Sadat City',
            'Zagazig University',
        ];
        foreach($universities as $university){
            University::create([
                'name' => $university,
            ]);
        }
    }
}
