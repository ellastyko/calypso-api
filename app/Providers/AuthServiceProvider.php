<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\{PostPolicy, CategoryPolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CategoryPolicy::class,
        PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Sanctum::usePersonalAccessClientModel(PersonalAccessClient::class);
//        Gate::define('edit-category', function (User $user) {
//            return $user->isAdmin()
//                ? Response::allow()
//                : Response::deny('You must be an administrator.');
//        });
    }
}
