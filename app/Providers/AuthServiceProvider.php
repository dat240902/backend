<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobSeeker;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function (Company $company, Job $job) {
            return $company->id === $job->company_id;
        });

        Gate::define('create-post', function (Company $company, int $company_id) {
            return $company->id === $company_id;
        });

        Gate::define('admin-only', function (JobSeeker $jobSeeker) {
            return $jobSeeker->role === 1;
        });
    }
}

