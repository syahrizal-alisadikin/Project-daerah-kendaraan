<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class HistoryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $history = History::with('user')->latest()->get();
             return DataTables::of($history)
                ->addColumn('waktu', function ($item) {
                    return $item->created_at->format('Y m d H:i:s');
                })
                ->addIndexColumn()
                ->make();
        }

        return view('admin.history.index');
    }
}
