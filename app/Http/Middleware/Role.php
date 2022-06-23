<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, String $role) 
  {
    // if (!Auth::check()) 
    //   return redirect('/');

    $user = Auth::user();
    if($user->role == $role)
      return $next($request);

    
      if($user->role == "vartotojas")
      return redirect('/');
  
      if($user->role == "administratorius")
      return redirect('/admin_dashboard');
  }
}