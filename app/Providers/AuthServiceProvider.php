<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){
            return $user->role === 'admin' ? true : null;
        });

        Gate::define('manage-employees', function($user, $employee = null) {
            $isCompany = $user->role === 'company';

            return $employee ? $isCompany && $employee->company_id === $user->company->id : $isCompany;
        });

        Gate::define('view-employee', function($user, $employee) {
            return $user->role === 'employee' && $user->id === $employee->user_id;
        });
    }
}
