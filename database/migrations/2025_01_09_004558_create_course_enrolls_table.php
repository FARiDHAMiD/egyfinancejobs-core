<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // student
            $table->foreignId('course_id')
                ->constrained('courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('enroll_statu')->default(null)->nullable(); // pending - accepted - rejected
            $table->integer('final_grade')->nullable();
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
        Schema::dropIfExists('course_enrolls');
    }
}
