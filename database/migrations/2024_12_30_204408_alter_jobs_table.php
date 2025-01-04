<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->smallInteger('years_experience_from')->nullable();
            $table->smallInteger('years_experience_to')->nullable();
            $table->integer('salary_from')->default(0);
            $table->integer('salary_to')->default(0);
            $table->boolean('net_gross')->default(0);
            $table->boolean('show_salary')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('salary');
            $table->dropColumn('years_experience');
        });
    }
}
