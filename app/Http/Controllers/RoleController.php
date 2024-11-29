<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'error' => 'Role not found',
            ], 404);
        }

        return response()->json($role);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $role = Role::create($request->all());

        return response()->json([
            'message' => 'Role created successfully',
            'data' => $role,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'error' => 'Role not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $role->update($request->all());

        return response()->json([
            'message' => 'Role updated successfully',
            'data' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'error' => 'Role not found',
            ], 404);
        }

        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully',
        ]);
    }
}
