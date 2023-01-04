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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('jobseeker_id')->constrained('job_seekers');
            $table->string('educations')->nullable();
            $table->string('experiences')->nullable();
            $table->string('skills')->nullable();
            $table->string('qualifications')->nullable();
            $table->timestamps();

            $table->unique(['job_id', 'jobseeker_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
