<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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

    public function check_permission($permission)
    {
     //   return true;
        $request = request();
        if ($request->user()->id == 1) return true;

        foreach($request->user()->roles as $user_role){
            $user_role = $user_role->id;
        }

        $permissions = Role::find($user_role)->permissions;
        $allow = false;

        foreach ($permissions as $key ) {
           if ($key->name == $permission) {
            $allow = true;
           }
        }
        return $allow;

    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {


        $this->registerPolicies();

         Gate::define('check', function($user,$param){
             //return  false;
            // return dd($param);
            return $this->check_permission($param);
         });



        //
    }
}
