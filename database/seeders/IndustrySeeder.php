<?php

namespace Database\Seeders;
use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Human Resources Services',
            'Technology, Information and Internet',
            'Software Development',
            'Appliances, Electrical, and Electronics Manufacturing',
            'IT Services and IT Consulting',
            'Hospitality',
            'Professional Services',
            'Accounting',
            'Manufacturing',
            'Pharmaceutical Manufacturing',
            'Retail',
            'Financial Services',
            'Business Consulting and Services',
            'Food and Beverage Services',
        ];
        foreach($data as $element){
            Industry::create([
                'name' => $element,
            ]);
        }
    }
}
