<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_application_id')->constrained('job_applications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_question_id')->constrained('job_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_answers');
    }
}
