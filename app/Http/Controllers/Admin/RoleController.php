<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:roles']);
    }

    public function index()
    {
        $roles = Role::latest()->when(request()->q, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->q . '%');
        })->paginate(5);

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::latest()->get();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->input('name')
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data $role->name ",

        ]);
        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if($role){
            //redirect dengan pesan sukses
            return redirect()->route('admin.role.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.role.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id
        ]);
        
        $role = Role::findOrFail($role->id);
        $role->update([
            'name' => $request->input('name')
        ]);

         History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Update data $role->name ",

        ]);
        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if($role){
            //redirect dengan pesan sukses
            return redirect()->route('admin.role.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.role.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
         History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Hapus data $role->name ",

        ]);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();

        if($role){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
