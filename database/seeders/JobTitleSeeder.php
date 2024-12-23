<?php

namespace Database\Seeders;
use App\Models\JobTitle;
use Illuminate\Database\Seeder;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Financial Controller',
            'Order Specialist',
            'Senior Accountant',
            'Data Analyst',
            'General Accountant',
            'Accounts Payable Accountant',
            'Project Manager',
            'Chef',
            'Treasury Accountant',
            'Salesperson',
            'Tax Accounting Manager',
            'Speaker',
            'Accounts Receivable Accountant',
            'Financial Analyst',
            'Accountant',
            'Administrative Assistant',
            'Account Manager',
            'Customer Service Representative',
        ];
        foreach($data as $element){
            JobTitle::create([
                'name' => $element,
            ]);
        }
    }
}
