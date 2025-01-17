<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptedByToCourseEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_enrolls', function (Blueprint $table) {

            $table->integer('accepted_by')->nullable(); // admin who approved enroll
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_enrolls', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
}
