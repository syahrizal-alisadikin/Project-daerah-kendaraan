<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\History;
use App\Models\SubUnit;
use App\Models\Unit;
use App\Models\Upb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subunit = SubUnit::when(request()->q, function($subunit) {
            $subunit = $subunit->where('name', 'like', '%'. request()->q . '%');
        })->with('unit.bidang')->whereHas('unit',function($query){
            $query->orderBy('unit_id');
        })->orderBy('unit_id')->paginate(10);
        return view('admin.subunit.index',compact('subunit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = Bidang::all();
        return view('admin.subunit.create',compact('bidang'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subunit = SubUnit::create([
            'unit_id' => $request->unit_id,
            'kode_sub_unit' => $request->kode_sub_unit,
            'name' => $request->name,
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Tambah data Subunit $subunit->name ",

        ]);
        
        return redirect()->route('admin.subunit.index')->with('success','Data berhasil ditambahkan!');
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
        $subunit = SubUnit::with('unit')->findOrFail($id);
        $unit = Unit::findOrFail($subunit->unit_id);
        $bidang = Bidang::all();

        return view('admin.subunit.edit',compact('subunit','unit','bidang'));
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
        $subunit = SubUnit::findOrFail($id);
        // dd($subunit);
        $subunit->update([
            'unit_id' => $request->unit_id,
            'kode_sub_unit' => $request->kode_sub_unit,
            'name' => $request->name,
        ]);

        History::create([
            'fk_admin_id' => Auth::user()->id,
            'aksi' => "Update data Subunit $subunit->name ",

        ]);

        return redirect()->route('admin.subunit.index')->with('success','Data berhasil di update!');

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
