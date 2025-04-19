<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DoumentController extends Controller
{
    public function document_create()
    {
       $documents =  DocumentType::latest()->get();
        return view('admin.document.create',compact('documents'));
    }
    public function document_store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|max:255',
        ]);


      DocumentType::create([
        'document_type'=>$request->document_type,
      ]);
      return redirect()->back();
    }
}
