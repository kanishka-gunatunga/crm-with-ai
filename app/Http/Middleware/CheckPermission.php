<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized.');
        }
 
        $role = Role::find($user->role);

        if (!$role) {
            abort(403, 'Role not found.');
        }

        if ($role->permission_type === 'all') {
            return $next($request);
        }
        $permissions = $role->permissions;

        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
        }

        if (!is_array($permissions) || !in_array($permission, $permissions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
