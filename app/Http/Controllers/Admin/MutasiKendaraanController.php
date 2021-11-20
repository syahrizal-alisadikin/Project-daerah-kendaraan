<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\History;
use App\Models\User;
use App\Models\MutasiKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MutasiKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('pimpinan')){

            $mutasi = MutasiKendaraan::when(request()->q, function($query) {
            $query = $query->where('no_surat', 'like', '%'. request()->q . '%');
        })->with('user','mutasi')->paginate(10);
        }else{
            $mutasi = MutasiKendaraan::when(request()->q, function($mutasi) {
            $mutasi = $mutasi->where('no_surat', 'like', '%'. request()->q . '%');
        })->where(function ($query) {
                $query->where('user_id', '=', Auth::user()->id)
                    ->orWhere('mutasi_id', '=', Auth::user()->id);
            })->with('user','mutasi')->paginate(10);

        }

        return view('admin.mutasi-kendaraan.index',compact('mutasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('pimpinan')){
            $kendaraan = Kendaraan::with('user')->where('status','ada')->get();
        }else{
            $kendaraan = Kendaraan::where('user_id',Auth::user()->id)->where('status','ada')->get();
        }
        

        if(auth()->user()->can('pimpinan')){
            $user = User::whereNotnull('bidang_id')->get();
        }else{
            $user = User::whereNot('user_id',Auth::user()->id)->whereNotnull('bidang_id')->get();
        }

        return view('admin.mutasi-kendaraan.create',compact('kendaraan','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'file'          => 'required|mimes:pdf|max:10000',
            'no_surat'      =>'required|unique:mutasi_kendaraans,no_surat'
           
        ],
        [
            'file.mimes' => "File Harus PDF"
        ]);

     // simpan foto
        $foto = $request->file('foto');
        $foto->storeAs('public/mutasikendaraan', $foto->hashName());
        // simpan file
        $file = $request->file('file');
        $file->storeAs('public/mutasikendaraan', $file->hashName());
        // update KEndaraan
        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
        $kendaraan->update([
            'status' => "ada",
            'user_id' => $request->mutasi_id
        ]);

         $mutasi = MutasiKendaraan::create([
            'kendaraan_id'      => $kendaraan->id,
            'user_id'       => $request->user_id,
            'mutasi_id'     => $request->mutasi_id,
            'no_surat'      => $request->no_surat,
            'tgl_surat'     => $request->tgl_surat,
            'keterangan'    => $request->keterangan,
            'status'        => "success",
            'foto'          => $foto->hashName(),
            'file'          => $file->hashName(),
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data Mutasi kendaraan $mutasi->no_surat ",
        ]);
        return redirect()->route('admin.mutasi-kendaraan.index')->with('success','data berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
