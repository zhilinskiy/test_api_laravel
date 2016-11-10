<?php

namespace App\Http\Middleware\Ver1;

use App\Models\Ver1\User;
use Closure;

class CheckKey
{
    /**
     * Handle an incoming request and check if it have
     * user_key and match db record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('user_key')) {
            $u = User::where('user_key', $request->input('user_key'))->first();
            if (isset($u->id)) {
                return $next($request);
            } else {
                return response('unauthorised', 402);
            }
        } else {
            return response('unauthorised', 401);
        }
    }
}
