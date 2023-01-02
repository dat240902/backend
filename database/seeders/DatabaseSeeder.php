<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobSeeker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(10)->create()->each(function ($company) {
            Job::factory(5)->create(['company_id' => $company->id]);
        });

        JobSeeker::factory(10)->create();

        // Create admin account
        DB::table('job_seekers')->insert([
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
