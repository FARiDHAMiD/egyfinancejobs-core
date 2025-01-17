<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('info');
            $table->foreignId('cat_id')->constrained('course_cats')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('course_types')->cascadeOnDelete();
            $table->foreignId('statu_id')->constrained('course_status')->cascadeOnDelete();
            $table->integer('user_id'); // later will be foreign -- created by
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->smallInteger('hours')->nullable();
            $table->smallInteger('max_enroll')->nullable();
            $table->smallInteger('price')->nullable();
            $table->string('place')->nullable();
            $table->string('prerequisite')->nullable();
            $table->string('video_url')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
