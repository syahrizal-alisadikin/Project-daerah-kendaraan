<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\History;
use App\Models\Upb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpbController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upb = Upb::when(request()->q, function($upb) {
            $upb = $upb->where('name', 'like', '%'. request()->q . '%');
        })->with('subUnit.unit.bidang')->orderBy('subunit_id')->paginate(10);
        return view('admin.upb.index',compact('upb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $bidang = Bidang::all();
        return view('admin.upb.create',compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upb = Upb::create([
            'subunit_id' => $request->subunit_id,
            'kode_upb' => $request->kode_upb,
            'name' => $request->name,
            'lokasi' => $request->lokasi,
        ]);

         History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data upb $upb->name ",
        ]);

        return redirect()->route('admin.upb.index')->with('success','data berhasil di tambahkan!!');
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
        $bidang = Bidang::all();
        $upb =  Upb::findOrFail($id);
        return view('admin.upb.edit',compact('bidang','upb'));
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
        $upb =  Upb::findOrFail($id);
         $upb->update([
            'subunit_id' => $request->subunit_id,
            'kode_upb' => $request->kode_upb,
            'name' => $request->name,
            'lokasi' => $request->lokasi,
        ]);

         History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "UPdate data Upb $upb->name ",
        ]);

        return redirect()->route('admin.upb.index')->with('success','data berhasil di tambahkan!!');
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
