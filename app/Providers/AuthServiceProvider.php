<?php

namespace App\Providers;
use App\Permissions;
use App\Posts;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Posts::class => \App\Policies\PostsPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        /*      
                The "getPermissions" is a function defined below the current function

                this gets the function from the permissions model and wraps it around the $permission variable
                it gets the link betweent he two models as says that within the gate funciton where the name of the permission in the 
                name column of the permissions table has that permission by cross-checking it to the role model's hasRol function
                it is done so so that it gets all the roles that have this permission

                ->roles is the function from the roles model
        */
         foreach ($this->getPermissions() as $permission) {
             $gate->define($permission->name, function($user) use ($permission){
                 return $user->hasRole($permission->roles);
             });
         }
         
    }

    protected function getPermissions()
    {
        return Permissions::with('roles')->get();
    }
}
