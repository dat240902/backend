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
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('resume_url')->default('');
            $table->string('avatar_url')->default('');
            $table->smallInteger('gender')->default(0);
            // 0 -> normal user, 1 -> admin
            $table->smallInteger('role')->default(0);
            $table->string('status')->default('free');
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
        Schema::dropIfExists('job_seekers');
    }
};
