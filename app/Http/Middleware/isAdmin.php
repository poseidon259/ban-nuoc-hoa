<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $UserRoles = DB::table('roles')->join('role_user','role_id', '=', 'roles.id')->where('user_id', '=', Auth::user()->id)->lists('name');
 
        $isAdmin = false;
        foreach($UserRoles as $role)
        {
            if($role == 'admin')
            {
                $isAdmin = true;
            }
        }


        if( ! $isAdmin )
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back(); //todo h peut-etre une fenetre modale pour dire acces refusé ici...
            }
        }

    return $next($request);
    }
}
