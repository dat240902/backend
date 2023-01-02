<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('title');
            $table->string('description')->nullable();
            // 0 -> unknown, 1 -> fulltime, 2->part-time, 3->others 
            $table->unsignedSmallInteger('type')->default(0);
            $table->text('benefits')->nullable();
            $table->string('position')->nullable();
            $table->unsignedInteger('min_salary')->default(0);
            $table->unsignedInteger('max_salary')->default(0);
            $table->string('address')->nullable();
            $table->string('requirements')->nullable();
            $table->foreignId('company_id')->constrained('companies');
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
        Schema::table('reviews', function ($table) {
            $table->dropForeign('reviews_job_id_foreign');
        });
        Schema::dropIfExists('jobs');
    }
};
