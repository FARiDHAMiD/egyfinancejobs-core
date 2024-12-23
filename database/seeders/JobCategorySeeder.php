<?php

namespace Database\Seeders;
use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Corporate Finance',
            'Investment Banking',
            'Asset Management',
            'Risk Management',
            'Accounting and Auditing',
            'Financial Planning',
            'Insurance and Actuarial Science',
            'Private Equity and Venture Capital',
            'Real Estate Finance',
            'Financial Technology',
            'Accounting/Auditing',
        ];
        foreach($data as $element){
            JobCategory::create([
                'name' => $element,
            ]);
        }
    }
}
