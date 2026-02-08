<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role as RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required',
        ]);

        $role = RoleModel::create([
            'name' => $request->name,
            'level' => $request->level,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $role = RoleModel::find($role->id);
        if ($role) {
            return response([
                'message' => 'success',
                'role' => $role,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'role' => 'role does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllRoles()
    {
        $roles = RoleModel::all();
        if ($roles) {
            return response([
                'message' => 'Success',
                'roles' => $roles,
            ]);
        } else {
            return response([
                'message' => 'error',
                'roles' => 'No roles in database',
            ]);
        }
    }

    public function getRole(Request $request)
    {
        $request->validate(['id' => 'required']);
        $role = RoleModel::find($request->id);
        if ($role) {
            return response([
                'message' => 'success',
                'role' => $role,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'role' => 'Role does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'level' => 'required',
        ]);
        $role = RoleModel::find($request->id);
        if ($role) {
            $role->name = $request->name;
            $role->level = $request->level;
            $role->user_id_updated = auth()->id();
            $role->save();

            return response([
                'message' => 'success',
                'role' => $role,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'role' => 'Role doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deleteRole(Request $request)
    {
        $request->validate(['id' => 'required']);
        $role = RoleModel::find($request->id);
        if ($role) {
            $role->delete();

            return response([
                'message' => 'success',
                'role' => 'Role has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'role' => 'Role does not exist!',
                'status' => 404,
            ]);
        }
    }
}
