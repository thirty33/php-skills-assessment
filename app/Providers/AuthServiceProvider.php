<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\User;

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

        Gate::define('user-management', function (User $user) {
            return $user->isAdmin()
                        ? Response::allow()
                        : Response::deny('You must be an administrator.');
        });

        Gate::define('user-favorites', function (User $user) {
            return $user->isCustomer()
                        ? Response::allow()
                        : Response::deny('You must be a customer.');
        });
    }
}
