<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class RemoveRoleFromUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Role $role): RedirectResponse
    {
        $user->removeRole($role);
        return back();
    }
}
