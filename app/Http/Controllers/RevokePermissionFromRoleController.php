<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RevokePermissionFromRoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role, Permission $permission): RedirectResponse
    {
        $role->revokePermissionTo($permission);
        return back();
    }
}
