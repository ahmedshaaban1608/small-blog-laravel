<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    protected function checkRole ($role){
        
        return function(User $user) use ($role){
            return $user->role === $role;
        };
    }
    public function boot(): void
    {
        Gate::define('is_admin',$this->checkRole('admin'));
        Gate::define('is_author',$this->checkRole('author'));
    }
}
