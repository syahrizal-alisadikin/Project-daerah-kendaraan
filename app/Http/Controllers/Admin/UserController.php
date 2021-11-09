<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:pimpinan.index']);
    
    }

    public function index()
    {
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap'  => 'required',
            'name'      => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        $user = User::create([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password'))
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "update data $user->name ",

        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('admin.user.edit', compact('user', 'roles'));
    }

     public function update(Request $request, User $user)
    {
        
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'name'      => 'required|unique:users,name,'.$user->id,
            'email'     => 'required|email|unique:users,email,'.$user->id
        ]);

        $user = User::findOrFail($user->id);

        if($request->input('password') == "") {
            $user->update([
                'nama_lengkap' => $request->input('nama_lengkap'),
                'name'      => $request->input('name'),
                'email'     => $request->input('email')
            ]);
        } else {
            $user->update([
                'nama_lengkap' => $request->input('nama_lengkap'),
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }

        //assign role
        $user->syncRoles($request->input('role'));
        // log activity
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "update data  $request->name ",
        ]);
        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "update data $user->name ",

        ]);
        $user->delete();


        if($user){
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
