<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('education_level_id')->constrained('education_levels')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('degree_details');
            $table->foreignId('university_id')->constrained('universities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('degree_date');
            $table->string('grade');
            $table->string('certificate_title')->nullable();
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
        Schema::dropIfExists('education');
    }
}
