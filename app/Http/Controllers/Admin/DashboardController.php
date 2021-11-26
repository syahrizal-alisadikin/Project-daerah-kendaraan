<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PinjamKendaraan;
use App\Models\PinjamTanah;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('pimpinan')){
            $kendaraan = Kendaraan::where('status','ada')->count();
            $tanah = Tanah::where('status','ada')->count();
            $pinjamkendaraan = PinjamKendaraan::where('status','pinjam')->count();
            $pinjamtanah = PinjamTanah::where('status','pinjam')->count();
        }else{
            $kendaraan = Kendaraan::where('user_id',Auth::user()->id)->where('status','ada')->count();
            $tanah = Tanah::where('user_id',Auth::user()->id)->where('status','ada')->count();
            $pinjamkendaraan = PinjamKendaraan::where('user_id',Auth::user()->id)->where('status','ada')->count();
            $pinjamtanah = PinjamTanah::where('user_id',Auth::user()->id)->where('status','ada')->count();
        }
        return view('admin.dashboard.index',compact('kendaraan','tanah','pinjamkendaraan','pinjamtanah'));
    }
}
