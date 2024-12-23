<?php

namespace Database\Seeders;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['English' , 'language'],
            ['Grmany' , 'language'],
            ['Spain' , 'language'],
            ['French' , 'language'],
            ['General Ledger' , 'technical'],
            ['Fixed Assets' , 'technical'],
            ['Financial Analysis' , 'technical'],
            ['Accounting' , 'technical'],
            ['Financial Statements' , 'technical'],
            ['Closing' , 'technical'],
            ['Accruals' , 'technical'],
            ['Financial Reporting' , 'technical'],
            ['Bookkeeping' , 'technical'],
            ['Internal Control' , 'technical'],
            ['Internal Audit' , 'technical'],
            ['External Audit' , 'technical'],
            ['Management Accounting' , 'technical'],
            ['Budgeting' , 'technical'],
            ['Accounts Receivable' , 'technical'],
            ['Accounts Payable' , 'technical'],
            ['Tax' , 'technical'],
            ['US GAAP' , 'technical'],
            ['IFRS' , 'technical'],
            ['Egyptian GAAP' , 'technical'],
            ['Bank Reconciliation' , 'technical'],
            ['Costing' , 'technical'],
            ['Cost management' , 'technical'],
            ['Balance Sheet' , 'technical'],
            ['Financial Position' , 'technical'],
            ['Cash flow' , 'technical'],
            ['Cash forecasting' , 'technical'],
            ['Cash Management' , 'technical'],
            ['Treasury' , 'technical'],
            ['Treasury Management' , 'technical'],
            ['Project Accounting' , 'technical'],
            ['Financing' , 'technical'],
            ['Statutory Reporting' , 'technical'],
            ['Financial Planning' , 'technical'],
            ['Financial Modeling' , 'technical'],
            ['SAP FICO' , 'technology'],
            ['Oracle' , 'technology'],
            ['Odoo' , 'technology'],
            ['Peachtree' , 'technology'],
            ['Quickbooks' , 'technology'],
            ['NetSuite' , 'technology'],
            ['Microsoft Dynamics' , 'technology'],
            ['SAGE' , 'technology'],
            ['Tally' , 'technology'],
            ['Communication' , 'soft'],
            ['Problem Solving' , 'soft'],
            ['Time Management' , 'soft'],
            ['Teamwork' , 'soft'],
            ['Attention to Detail' , 'soft'],
            ['Adaptability' , 'soft'],
            ['Leadership' , 'soft'],
            ['Analytical Thinking' , 'soft'],
            ['Presentation Skills' , 'soft'],
            ['Decision-Making' , 'soft'],
        ];
        foreach($data as $element){
            Skill::create([
                'name' => $element[0],
                'category' => $element[1],
            ]);
        }
    }
}
