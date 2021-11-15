<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubUnit;
use App\Models\Tanah;
use App\Models\Unit;
use App\Models\Upb;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function ApiUnit($id)
    {
        $unit = Unit::where('bidang_id',$id)->get();
        return response()->json($unit);
    }

    public function ApiSubUnit($id)
    {
        $subunit = SubUnit::where('unit_id',$id)->get();
        return response()->json($subunit);
    }

    public function ApiUpb($id)
    {
        $upb = Upb::where('subunit_id',$id)->get();
        return response()->json($upb);


    }

    public function ApiUser($id)
    {
        $user = User::with('bidang','unit','subunit','upb')->findOrFail($id);
        return response()->json($user);

    }

    public function ApiTanah($id)
    {
        $tanah = Tanah::with('user.bidang','user.unit','user.subunit','user.upb')->findOrFail($id);
        return response()->json($tanah);
    }
}
