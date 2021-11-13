<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LuasTanahController extends Controller
{
    public function index()
    {
        return view('admin.tanah.index');
    }

    public function create()
    {
        return view('admin.tanah.create');
    }
}
