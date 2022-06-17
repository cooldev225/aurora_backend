<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;

class EnsureRole
{
    /**
     * Check Role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $result = UserRole::where('slug', $role)
            ->get()
            ->toArray();

        if (empty($result)) {
            return response()->json([
                'message' => 'Access Denied',
            ]);
        }

        $user_role = $result[0];

        if (auth()->user()->role_id != $user_role['id']) {
            return response()->json([
                'message' => $user_role['name'] . ' Role Required',
            ]);
        }

        return $next($request);
    }
}