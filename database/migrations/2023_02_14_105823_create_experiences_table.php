<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('job_title');
            $table->string('company_name');
            $table->foreignId('job_category_id')->constrained('job_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_industry_id')->constrained('industries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_type_id')->constrained('job_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('currently_work_there');
            $table->date('starting_from');
            $table->date('ending_in')->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
