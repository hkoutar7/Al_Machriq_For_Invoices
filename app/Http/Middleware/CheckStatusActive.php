<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatusActive
{
    public function handle(Request $request, Closure $next)
    {
        if ( !$request->user()->status)
        {
            session()->flash('user_denied_permission','حدث خطا اثناء التسجيل المرجو التواصل مع الادمن');
            return redirect()->back();
        }

        return $next($request);
    }
}
