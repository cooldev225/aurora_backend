<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserRole;

class EnsureRole
{
    /**
     * Check Role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null $slugs
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$slugs)
    {
        $required_role = UserRole::whereIn('slug', $slugs)->first();

        $role = auth()
            ->user()
            ->role;

        if (!in_array($role->slug, $slugs) && $role->slug != 'admin') {
            return response()->json(
                [
                    'message' => $required_role->name . ' Role Required',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        return $next($request);
    }
}
