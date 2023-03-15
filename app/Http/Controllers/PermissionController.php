<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Permissions/PermissionIndex', [
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Permissions/Create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePermissionRequest $request): RedirectResponse
    {
        Permission::create($request->validated());
        return to_route('permissions.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): Response
    {
        return Inertia::render('Admin/Permissions/Edit', [
            'permission' => new PermissionResource($permission)
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return to_route('permissions.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return back();
    }
}
