<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.role.index')->with(['roles' => $roles]);
    }
    public function create()
    {
        return view('backend.role.create');
    }
    public function store(Request $request)
    {
        $dataIn = $request->all();
        $validator = Validator::make($dataIn , [
            'name' => 'string|required'
        ])->validate();
        $dataIn['guard_name'] = 'admin';
        try {
            $role = Role::create($dataIn);
            if (isset($request->permissions)) {
                foreach ($request->permissions as $key => $value) {
                    $role->givePermissionTo($value);
                }

            }
        } catch (\Exception $e)
        {
            throw $e;
        }
        return redirect()->route('admin.roles.index');
    }
    public function edit($id)
    {

            $role = Role::findOrFail($id);
        return view('backend.role.edit')->with(['role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $validator = Validator::make($dataUp , [
            'name' => 'string|required'
        ])->validate();
        try {
            $role = Role::findOrFail($id);

            $dataUp['updated_by'] = '';
            $role->update($dataUp);
            $role->rolePermissions()->delete();
            if (isset($request->permissions)) {
                foreach ($request->permissions as $key => $value) {
                    $role->givePermissionTo($value);
                }
            }
        }catch (\Exception $e){
            throw $e;
        }
        return redirect()->route('admin.roles.index');
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
