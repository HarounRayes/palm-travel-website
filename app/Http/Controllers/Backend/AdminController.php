<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::all();

        return view('backend.user.index')->with(['admins' => $admins]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.user.create')->with(['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $dataIn = $request->all();
        $dataIn['password'] = Hash::make($request->password);
        try {
            $admin = Admin::create($dataIn);
            $admin->syncRoles($dataIn['role']);
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->intended(route('admin.users.index'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $admin = Admin::findOrFail($id);
        return view('backend.user.edit')->with(['roles' => $roles, 'admin' => $admin]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('admins')->ignore($id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('admins')->ignore($id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $dataIn['name'] = $request->name;
        $dataIn['email'] = $request->email;
        $dataIn['username'] = $request->username;
        $dataIn['role'] = $request->role;
        if (isset($request->password) && $request->password != '')
            $dataIn['password'] = Hash::make($request->password);

        try {
            $admin = Admin::findOrFail($id);
            $admin->update($dataIn);
            $admin->syncRoles($dataIn['role']);
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->intended(route('admin.users.index'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.users.index');
    }
}
