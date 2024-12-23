<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
            $table->integer('total_employees')->default(0);
            $table->integer('used_employees')->default(0);
            $table->integer('total_jobs')->default(0);
            $table->integer('used_jobs')->default(0);
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
        Schema::dropIfExists('plan_requests');
    }
}
