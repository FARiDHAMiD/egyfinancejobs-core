<?php

namespace Database\Seeders;
use App\Models\JobQuestion;
use Illuminate\Database\Seeder;

class JobQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $job_questions = [
            "How many years of experience do you have in accounting/finance/business?",
            "Do you have experience with X software?",
            "What accounting/finance/business certifications do you have?",
            "What is your experience with financial reporting?",
            "Have you ever led a team in accounting/finance/business?",
            "What are your skills in analyzing financial data?",
            "What is your experience in budgeting and forecasting?",
            "Do you have experience with X accounting/finance/business system?",
            "What is your experience with tax regulations?",
            "What is your experience with auditing?",
            "Have you worked in a public accounting/finance/business firm?",
            "What is your experience with financial statement analysis?",
            "Do you have experience in project management?",
            "What is your experience with X accounting/finance/business process?",
            "Do you have experience with cost accounting/finance/business?",
            "What is your experience with financial modeling?",
            "Do you have experience with X business strategy?",
            "What is your experience with risk management?",
            "Have you worked with X industry before?",
            "What is your experience with international accounting/finance/business standards?",
            "Do you have experience with X type of investment?",
            "What is your experience with data analytics?",
            "Do you have experience in managing a financial/accounting/business team?",
            "What is your experience with X regulatory compliance?",
            "What is your experience with cash management?",
            "Do you have experience with X type of financial statement?",
            "What is your experience with mergers and acquisitions?",
            "Do you have experience with X accounting/finance/business analysis tool?",
            "What is your experience with X type of financial analysis?",
        ];
        

        for ($i=1; $i <= 60; $i++) {
            JobQuestion::create([
                'job_id' => rand(1,30),
                'question' => $job_questions[rand(0,28)],
            ]);
        } 
    }
}
