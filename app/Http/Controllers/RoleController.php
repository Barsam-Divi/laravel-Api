<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\SingleRoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json([
           'data' => [
               'roles' => RoleResource::collection(Role::all())
           ]
        ]);
    }

    public function show(Role $role)
    {
        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role)
            ]
        ]);
    }

    public function store(NewRoleRequest $request)
    {

        $role = Role::query()->create([
            'title' => $request->get('title')
        ]);


        if ($request->filled('permissions'))
        {
            $permissions = Permission::query()
                ->whereIn('id' , $request->get('permissions'))
                ->get();
            $role->permissions()->attach($permissions);
        }

        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role)
            ]
        ])->setStatusCode(201);
    }

    public function update(Role $role,UpdateRoleRequest $request)
    {

        $titleExists = Role::query()->where('title' , $request->get('title'))
            ->where('id' ,'!=' ,$role->id)
            ->exists();

        if ($titleExists)
        {
            return response()->json([
                'data'  => [
                    'message' => 'title is already exists'
                ]
            ])->setStatusCode(400);
        }

        $role->update([
            'title' => $request->get('title',$role->title)
        ]);

        if ($request->filled('permissions'))
        {
            $permissions = Permission::query()
                ->whereIn('id' , $request->get('permissions'))
                ->get();



            $role->permissions()->sync($permissions);
        }
        else
        {
            $role->permissions()->detach();
        }



        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role)
            ]
        ])->setStatusCode(201);

    }

    public function destroy(Role $role)
    {
        $RoleHaveUser = $role->users()->count();

        if ($RoleHaveUser)
        {
            return response()->json([
                'data' =>
                [
                    'message' => 'role have many users'
                ]
            ])->setStatusCode(400);
        }

        $role->permissions()->detach();

        $role->delete();


        return  response()->json([
            'data' => [
                'message' => $role->title.' '.'success fully deleted'
            ]
        ])->setStatusCode(200);

     }
}
