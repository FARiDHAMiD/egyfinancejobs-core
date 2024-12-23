<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('job_title');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('education_level_id')->constrained('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->constrained('job_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('career_level_id')->constrained('career_levels')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('years_experience');
            $table->integer('salary');
            $table->longText('job_description');
            $table->text('job_excerpt');
            $table->longText('job_requirements');
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
        Schema::dropIfExists('jobs');
    }
}
