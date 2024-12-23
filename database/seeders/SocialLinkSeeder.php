<?php

namespace Database\Seeders;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=2; $i <= 41; $i++) {
            

            SocialLink::create([
                'user_id' => $i,
                'facebook' => rand(0,1) == 0 ? '' : 'https://www.facebook.com/',
                'linkedin' => rand(0,1) == 0 ? '' : 'https://www.linkedin.com/',
                'youtube' => rand(0,1) == 0 ? '' : 'https://www.youtube.com/',
                'website' => rand(0,1) == 0 ? '' : 'google.com',
                'other' => '',
            ]);
        }
    }
}
