<?php

namespace Database\Seeders;
use App\Models\JobApplication;
use App\Models\JobApplicationAnswer;
use App\Models\JobQuestion;
use Illuminate\Database\Seeder;

class JobApplicationAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_applications = JobApplication::all();
        foreach($job_applications as $job_application){

            $job_questions = JobQuestion::where('job_id' , $job_application->job_id)->get();
            foreach($job_questions as $index => $job_question){
                JobApplicationAnswer::create([
                    'job_id' => $job_application->job_id,
                    'job_application_id' => $job_application->id,
                    'job_question_id' => $job_question->id,
                    'employee_id' => $job_application->employee_id,
                    'answer' => $index.' Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates cupiditate id, quibusdam nostrum tempore labore ratione? Consectetur deleniti veritatis reprehenderit. Quia animi repudiandae corporis eius quod optio facere ducimus ipsa.',
                ]);
            }
        }
    }
}
