<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $roleIds = ['superadmin' => 1, 'admin' => 2, 'superviser' => 3];
        $allowedRoleIds = [];
        foreach ($roles as $role)
        {
           if(isset($roleIds[$role]))
           {
               $allowedRoleIds[] = $roleIds[$role];
           }
        }
        $allowedRoleIds = array_unique($allowedRoleIds); 

        if(Auth::check()) {
          if(in_array(Auth::user()->role_id, $allowedRoleIds)) {
            return $next($request);
          }
        }

        // return redirect('/');
        return redirect()->back();

    }
}