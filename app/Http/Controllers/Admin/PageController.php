<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Traffic;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $traffic = Traffic::all();
        return view('admin.home', compact('traffic'));
    }
}
