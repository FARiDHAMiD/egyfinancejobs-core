<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('career_level_id')->constrained('career_levels')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('accepted_salary', 10, 2)->nullable();
            $table->boolean('show_salary')->nullable();
            $table->boolean('searchable')->nullable();
            $table->boolean('profile_public')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('area_id')->nullable()->constrained('areas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('military_status')->nullable();
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
        Schema::dropIfExists('employee_profiles');
    }
}
