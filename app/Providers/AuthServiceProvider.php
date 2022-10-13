<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enum\UserRoleEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('isOwner', fn($user) => $user->role == UserRoleEnum::ROLE_OWNER);
        Gate::define('isAdmin', fn($user) => $user->role == UserRoleEnum::ROLE_ADMIN);
    }
}
