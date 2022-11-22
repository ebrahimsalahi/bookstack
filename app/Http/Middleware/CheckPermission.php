<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class CheckPermission
{

    public function check_permission($permission)
    {
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


    public function handle($request, Closure $next,$role)
    {

        if ($this->check_permission($role) == true) {
            return $next($request);
        }else{
            return abort(403);

            return redirect(route('home'));
        }

    }


}
