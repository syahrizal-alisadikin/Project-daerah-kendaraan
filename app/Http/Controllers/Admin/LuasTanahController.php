<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanah;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuasTanahController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('pimpinan')){
            $tanah = Tanah::when(request()->q, function($tanah) {
            $tanah = $tanah->where('name', 'like', '%'. request()->q . '%');
        })->with('user')->paginate(10);
        }else{
            $tanah = Tanah::when(request()->q, function($tanah) {
            $tanah = $tanah->where('name', 'like', '%'. request()->q . '%');
        })->with('user')->where('user_id',Auth::user()->id)->paginate(10);

        }
        return view('admin.tanah.index',compact('tanah'));
    }

    public function create()
    {
        $user = User::whereNotnull('bidang_id')->get();
        return view('admin.tanah.create',compact('user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'file'          => 'required|mimes:pdf|max:10000',
           
        ],
    [
        'file.mimes' => "File Harus PDF"
    ]);
        // simpan foto
        $foto = $request->file('foto');
        $foto->storeAs('public/tanah', $foto->hashName());
        // simpan file
        $file = $request->file('file');
        $file->storeAs('public/tanah', $file->hashName());
        // simpan ke databse
        $tanah = Tanah::create([
            'name'          => $request->name,
            'user_id'       => $request->user_id,
            'kode_barang'   => $request->kode_barang,
            'register'      => $request->register,
            'no_sertifikat' => $request->no_sertifikat,
            'no_pbb'        => $request->no_ppb,
            'tahun_perolehan' => $request->tahun_perolehan,
            'luas'          => $request->luas,
            'harga'         => $request->harga,
            'kondisi'       => $request->kondisi,
            'tgl_surat'     => $request->tgl_surat,
            'asal_usul'     => $request->asal_usul,
            'status'        => $request->status,
            'alamat'        => $request->alamat,
            'kelurahan'     => $request->kelurahan,
            'kecamatan'     => $request->kecamatan,
            'keterangan'     => $request->keterangan,
            'foto'          => $foto->hashName(),
            'file'          => $file->hashName(),
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data tanah $tanah->name ",

        ]);
        return redirect()->route('admin.tanah.index')->with('success','data berhasil di simpan');
    }

    public function edit($id)
    {
        $tanah = Tanah::with('user')->findOrFail($id);
        // return $tanah;
        $user = User::whereNotnull('bidang_id')->get();

        return view('admin.tanah.edit',compact('tanah','user'));
    }

    public function update(Request $request,$id)
    {
        $tanah = Tanah::with('user')->findOrFail($id);
        if($request->file('foto')){
            $this->validate($request, [
            'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2000',
           
        ],
        [
            'file.mimes' => "File Harus PDF"
        ]);
             // simpan foto
        $foto = $request->file('foto');
        $foto->storeAs('public/tanah', $foto->hashName());
        
        }

        if( $request->file('file')){
            // simpan file
              $this->validate($request, [
            'file'          => 'required|mimes:pdf|max:10000',
                
                ],
            [
                'file.mimes' => "File Harus PDF"
            ]);
        $file = $request->file('file');
        $file->storeAs('public/tanah', $file->hashName());
        }
        $tanah->update([
            'name'          => $request->name,
            'user_id'       => $request->user_id,
            'kode_barang'   => $request->kode_barang,
            'register'      => $request->register,
            'no_sertifikat' => $request->no_sertifikat,
            'no_pbb'        => $request->no_ppb,
            'tahun_perolehan' => $request->tahun_perolehan,
            'luas'          => $request->luas,
            'harga'         => $request->harga,
            'kondisi'       => $request->kondisi,
            'tgl_surat'     => $request->tgl_surat,
            'asal_usul'     => $request->asal_usul,
            'status'        => $request->status,
            'alamat'        => $request->alamat,
            'kelurahan'     => $request->kelurahan,
            'kecamatan'     => $request->kecamatan,
            'keterangan'     => $request->keterangan,
            'foto'          => $request->file('foto') != null ? $foto->hashName() : $tanah->foto,
            'file'          => $request->file('file') != null ? $file->hashName() : $tanah->file,
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Update data tanah $tanah->name ",

        ]);
        return redirect()->route('admin.tanah.index')->with('success','data berhasil di update');

    }
}
