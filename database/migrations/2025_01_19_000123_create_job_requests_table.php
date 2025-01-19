<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('company');
            $table->string('email');

            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->integer('education_level_id')->nullable();
            $table->integer('career_level_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->smallInteger('years_experience_from')->nullable();
            $table->smallInteger('years_experience_to')->nullable();
            $table->integer('salary_from')->default(0);
            $table->integer('salary_to')->default(0);
            $table->boolean('net_gross')->default(0);
            $table->boolean('show_salary')->default(0);
            $table->text('questions');
            $table->string('url_link')->nullable();
            $table->boolean('approved')->default(0);
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
        Schema::dropIfExists('job_requests');
    }
}
