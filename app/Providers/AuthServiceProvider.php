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

        Gate::define('view-employees', function($user) {
            return $user->role === 'company';
        });

        Gate::define('view-employee', function($user, $employee) {
            return $user->employee->id === $employee->id;
        });
    }
}
