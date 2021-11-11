<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $permissions = Permission::orderBy('name','ASC')->when(request()->q, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->q . '%');
        })->paginate(5);

        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions'
        ]);

        $permission = Permission::create([
            'name' => $request->input('name')
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data $permission->name ",

        ]);

        if($permission){
            //redirect dengan pesan sukses
            return redirect()->route('admin.permission.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.permission.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit',compact('permission'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$id
            // 'name' => 'required|unique:roles,name,'.$role->id
        ]);
        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name
        ]);
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Update data $permission->name ",

        ]);
        if($permission){
            //redirect dengan pesan sukses
            return redirect()->route('admin.permission.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.permission.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Hapus data $permission->name ",

        ]);
        $permission->delete();

        if($permission){
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
