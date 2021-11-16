<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Kendaraan;
use App\Models\PinjamKendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('pimpinan')){

            $pinjam = PinjamKendaraan::with('user','pinjam')->paginate(10);
        }else{
            $pinjam = PinjamKendaraan::where(function ($query) {
                $query->where('user_id', '=', Auth::user()->id)
                    ->orWhere('pinjam_id', '=', Auth::user()->id);
            })->with('user','pinjam')->paginate(10);

        }
        return view('admin.pinjam-kendaraan.index',compact('pinjam'));
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
        // User

        if(auth()->user()->can('pimpinan')){
            $user = User::whereNotnull('bidang_id')->get();
        }else{
            $user = User::whereNot('user_id',Auth::user()->id)->whereNotnull('bidang_id')->get();
        }

        return view('admin.pinjam-kendaraan.create',compact('kendaraan','user'));
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
            'no_surat'      =>'required|unique:pinjam_kendaraans,no_surat'
           
        ],
        [
            'file.mimes' => "File Harus PDF"
        ]);

          // simpan foto
        $foto = $request->file('foto');
        $foto->storeAs('public/pinjamkendaraan', $foto->hashName());
        // simpan file
        $file = $request->file('file');
        $file->storeAs('public/pinjamkendaraan', $file->hashName());

        // Update status Tanah Jadi di pinjam
        $tanah = Kendaraan::findOrFail($request->kendaraan_id);
        $tanah->update(['status' => "dipinjam"]);

        $pinjam = PinjamKendaraan::create([
            'kendaraan_id'      => $tanah->id,
            'user_id'       => $request->user_id,
            'pinjam_id'     => $request->pinjam_id,
            'no_surat'      => $request->no_surat,
            'tgl_surat'     => $request->tgl_surat,
            'tgl_pinjam'    => $request->tgl_pinjam,
            // 'tgl_kembali'   => $request->tgl_kembali,
            'status'        => "dipinjam",
            'foto'          => $foto->hashName(),
            'file'          => $file->hashName(),
        ]);
        
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data Pinjam kendaraan $pinjam->no_surat ",

        ]);
        return redirect()->route('admin.pinjam-kendaraan.index')->with('success','data berhasil ditambahkan!!');
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

    public function kembaliKendaraan($id)
    {
        
        $pinjamkendaraan = PinjamKendaraan::findOrFail($id);
        // return $pinjamkendaraan;
        $kendaraan = Kendaraan::findOrFail($pinjamkendaraan->kendaraan_id);
        $kendaraan->update(['status' => 'ada']);

        $pinjamkendaraan->update([
            'status' => "dikembalikan",
            'tgl_kembali' => date('Y-m-d')
        ]);

       if($pinjamkendaraan){
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
