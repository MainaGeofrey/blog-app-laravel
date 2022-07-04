<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    //map the model to the policy
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //this runs first bf the authorizATION RULES
        // the logic inside the Gate::before will return true when a user has an ‘admin’ role.
        //If the Gate returns false, then it’ll continue to check the authorization in our registered policies.
        Gate::before(function (User $user)
        {
            if ($user->profiles->pluck('name')->contains('admin')){
                return true;
            }
        });
    }
}
