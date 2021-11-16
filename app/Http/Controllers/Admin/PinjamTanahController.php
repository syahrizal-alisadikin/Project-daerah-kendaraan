<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\PinjamTanah;
use App\Models\Tanah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('pimpinan')){

            $pinjam = PinjamTanah::with('user','pinjam')->paginate(10);
        }else{
            $pinjam = PinjamTanah::where(function ($query) {
                $query->where('user_id', '=', Auth::user()->id)
                    ->orWhere('pinjam_id', '=', Auth::user()->id);
            })->with('user','pinjam')->paginate(10);

        }
        return view('admin.pinjam-tanah.index',compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(auth()->user()->can('pimpinan')){
            $tanah = Tanah::with('user')->where('status','ada')->get();
        }else{
            $tanah = Tanah::where('user_id',Auth::user()->id)->where('status','ada')->get();
        }

        if(auth()->user()->can('pimpinan')){
            $user = User::whereNotnull('bidang_id')->get();
        }else{
            $user = User::whereNot('user_id',Auth::user()->id)->whereNotnull('bidang_id')->get();
        }

        return view('admin.pinjam-tanah.create',compact('tanah','user'));
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
            'no_surat'      =>'required|unique:pinjam_tanahs,no_surat'
           
        ],
        [
            'file.mimes' => "File Harus PDF"
        ]);
        // simpan foto
        $foto = $request->file('foto');
        $foto->storeAs('public/pinjamtanah', $foto->hashName());
        // simpan file
        $file = $request->file('file');
        $file->storeAs('public/pinjamtanah', $file->hashName());

        // Update status Tanah Jadi di pinjam
        $tanah = Tanah::findOrFail($request->tanah_id);
        $tanah->update(['status' => "dipinjam"]);

        $pinjam = PinjamTanah::create([
            'tanah_id'      => $tanah->id,
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
            'aksi' => "Tambah data Pinjam tanah $pinjam->no_surat ",

        ]);
        return redirect()->route('admin.pinjam-tanah.index')->with('success','data berhasil ditambahkan!!');
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
        $pinjamTanah = PinjamTanah::with('tanah','user.bidang','user.unit','user.subunit','user.upb')->findOrFail($id);
        if(auth()->user()->can('pimpinan')){
            $tanah = Tanah::with('user')->where('status','ada')->get();
        }else{
            $tanah = Tanah::where('user_id',Auth::user()->id)->where('status','ada')->get();
        }

        if(auth()->user()->can('pimpinan')){
            $user = User::whereNotnull('bidang_id')->get();
        }else{
            $user = User::whereNot('user_id',Auth::user()->id)->whereNotnull('bidang_id')->get();
        }
        return view('admin.pinjam-tanah.edit',compact('tanah','user','pinjamTanah'));

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
        // return $request->all();
        $pinjamTanah = PinjamTanah::findOrFail($id);
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
         $pinjamTanah->update([
            'tanah_id'      => $request->tanah_id,
            'user_id'       => $request->user_id,
            'pinjam_id'     => $request->pinjam_id,
            'no_surat'      => $request->no_surat,
            'tgl_surat'     => $request->tgl_surat,
            'tgl_pinjam'    => $request->tgl_pinjam,
            // 'tgl_kembali'   => $request->tgl_kembali,
            'status'        => $request->status,
            'foto'          => $request->file('foto') != null ? $foto->hashName() : $pinjamTanah->foto,
            'file'          => $request->file('file') != null ? $file->hashName() : $pinjamTanah->file,
        ]);
        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "update data Pinjam tanah $pinjamTanah->no_surat ",

        ]);

        return redirect()->route('admin.pinjam-tanah.index')->with('success','data berhasil diupdate!!');

        
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

    public function kembaliTanah($id)
    {
        $pinjamTanah = PinjamTanah::findOrFail($id);
        $tanah = Tanah::findOrFail($pinjamTanah->tanah_id);
        $tanah->update(['status' => 'ada']);

        $pinjamTanah->update([
            'status' => "dikembalikan",
            'tgl_kembali' => date('Y-m-d')
        ]);

       if($pinjamTanah){
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
