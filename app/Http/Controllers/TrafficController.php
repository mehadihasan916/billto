<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function index()
    {
        $traffics = Traffic::with('user')->get();
        // dd($traffics);
        return view('admin.traffic.index', compact('traffics'));
    }
}
