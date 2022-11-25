<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Group;
use Session;
use App;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::check() && Auth::user()->user_type == "admin"){
        $group = Group::find(Auth::user()->group_id);
        if($group)
          Auth::user()->permissions = $group->permissions;
        else
          Auth::user()->permissions = [];

        if(Session::has('admin_lang'))
          App::setLocale(Session::get('admin_lang'));
        else{
          Session::put('admin_lang', 'en');
          App::setLocale('en');
        }

        Auth::user()->group = $group->{'name_'.Session::get('admin_lang')};

        return $next($request);
      }else {
        return redirect('/admin/login');
      }
    }
}
