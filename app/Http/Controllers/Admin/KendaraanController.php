<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('pimpinan')){
            $kendaraan = Kendaraan::when(request()->q, function($kendaraan) {
            $kendaraan = $kendaraan->where('no_polisi', 'like', '%'. request()->q . '%');
        })->with('user')->paginate(10);
        }else{
            $kendaraan = Kendaraan::when(request()->q, function($kendaraan) {
            $kendaraan = $kendaraan->where('no_polisi', 'like', '%'. request()->q . '%');
        })->with('user')->where('user_id',Auth::user()->id)->paginate(10);
        }
        return view('admin.kendaraan.index',compact('kendaraan'));
    }

    public function create()
    {
        $user = User::whereNotnull('bidang_id')->get();

        return view('admin.kendaraan.create',compact('user'));
    }

    public function store(Request $request)
    {
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
        $kendaraan = Kendaraan::create([
            'user_id'       => $request->user_id,
            'type_roda'     => $request->type_roda,
            'kode_barang'   => $request->kode_barang,
            'register'      => $request->register,
            'tahun_perolehan' => $request->tahun_perolehan,
            'harga'         => $request->harga,
            'merk'          => $request->merk,
            'type'          => $request->type,
            'no_polisi'     => $request->no_polisi,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'        => $request->no_mesin,
            'no_bpkb'        => $request->no_bpkb,
            'status'        => $request->status,
            'masa_berlaku_stnk'     => $request->masa_berlaku_stnk,
            'keterangan'     => $request->keterangan,
            'foto'          => $foto->hashName(),
            'file'          => $file->hashName(),
        ]);
        
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Update data kendaraan $kendaraan->no_polisi ",

        ]);
        return redirect()->route('admin.kendaraan.index')->with('success','Data berhasil di Update!!');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::with('user')->findOrFail($id);
        // return $tanah;
        $user = User::whereNotnull('bidang_id')->get();

        return view('admin.kendaraan.edit',compact('kendaraan','user'));
    }

    public function update(Request $request,$id)
    {
         $kendaraan = Kendaraan::findOrFail($id);
              // simpan foto
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
        // simpan ke databse
        $kendaraan->update([
            'user_id'       => $request->user_id,
            'type_roda'     => $request->type_roda,
            'kode_barang'   => $request->kode_barang,
            'register'      => $request->register,
            'tahun_perolehan' => $request->tahun_perolehan,
            'harga'         => $request->harga,
            'merk'          => $request->merk,
            'type'          => $request->type,
            'no_polisi'     => $request->no_polisi,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'        => $request->no_mesin,
            'no_bpkb'        => $request->no_bpkb,
            'status'        => $request->status,
            'masa_berlaku_stnk'     => $request->masa_berlaku_stnk,
            'keterangan'     => $request->keterangan,
            'foto'          => $request->file('foto') != null ? $foto->hashName() : $kendaraan->foto,
            'file'          => $request->file('file') != null ? $file->hashName() : $kendaraan->file,
        ]);
        
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data kendaraan $kendaraan->no_polisi ",

        ]);
        return redirect()->route('admin.kendaraan.index')->with('success','Data berhasil di tambah!!');
    }
}
