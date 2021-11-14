<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:pimpinan']);
    
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
        $bidang = Bidang::all();
        return view('admin.user.create', compact('roles','bidang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap'  => 'required',
            'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'name'      => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);
        $image = $request->file('foto');
        $image->storeAs('public/users', $image->hashName());
        $user = User::create([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'foto' => $image->hashName(),
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'bidang_id'     => $request->input('bidang_id'),
            'unit_id'     => $request->input('unit_id'),
            'subunit_id'     => $request->input('subunit_id'),
            'upb_id'     => $request->input('upb_id'),

        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data user $user->name ",

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
            'email'     => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user = User::findOrFail($user->id);
        if($request->file('foto')){
            $image = $request->file('foto');
            $image->storeAs('public/users', $image->hashName());
        }

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'foto'         => $request->file('foto') != null ? $image->hashName() : $user->foto ,
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'foto'         => $request->file('foto') != null ? $image->hashName() : $user->foto ,

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

    // Setting akun
    public function Setting()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('admin.user.setting',compact('user'));
    }

     public function UpdateAkun(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'name'      => 'required|unique:users,name,'.$user->id,
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'   => 'required|confirmed'  
        ]);

        if($request->file('foto')){
            $image = $request->file('foto');
            $image->storeAs('public/users', $image->hashName());
        }

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'foto'         => $request->file('foto') != null ? $image->hashName() : $user->foto ,
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'foto'         => $request->file('foto') != null ? $image->hashName() : $user->foto ,

            ]);
        }

        // log activity
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "update data  $request->name ",
        ]);
        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('setting-akun')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('setting-akun')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
