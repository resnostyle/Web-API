<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-premium', function($user) {
           return optional($user->role)->isElevated();
        });

        Gate::define('moderate', function ($user) {
            return (optional($user->role)->id == Role::ROLE_MODERATOR);
        });

        Gate::define('administrate', function($user) {
            return (optional($user->role)->id == Role::ROLE_ADMIN);
        });
    }
}
