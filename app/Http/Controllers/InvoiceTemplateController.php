<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreInvoiceTemplateRequest;

class InvoiceTemplateController extends Controller
{
    public function create()
    {
        $data = [
            'invoiceTemplates' => InvoiceTemplate::paginate(5),
        ];
        return view('admin.template.create', $data);
    }


    public function store(StoreInvoiceTemplateRequest $request)
    {
        $invoiceTemplate = new InvoiceTemplate();
        $invoiceTemplate->templateName = $request->templateName;
        $invoiceTemplate->templateDesignHtml = $request->templateDesignHtml;
        if ($request->hasFile('templateImage')) {
            $file = $request->file('templateImage');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            // dd( $filename);
            $file->move('uploads/template/', $filename);
            $invoiceTemplate->templateImage = $filename;
        }
        $invoiceTemplate->company = 'not company';
        $invoiceTemplate->save();
        return redirect()->back()->with('message', 'Successfully create Invoice');
    }


    public function edit($id)
    {
        $data = [
            'invoiceTemplateForEdit' => InvoiceTemplate::findOrFail($id),
        ];
        // dd($data);
        return view('admin.template.edit',$data);
    }


    public function update(StoreInvoiceTemplateRequest $request, $id)
    {
        $get_id = $id;
        $invoiceTemplate = InvoiceTemplate::find($get_id);
        $invoiceTemplate->templateName = $request->templateName;
        $invoiceTemplate->templateDesignHtml = $request->templateDesignHtml;
        if ($request->hasFile('templateImage')) {
            $path = 'uploads/template/' . $invoiceTemplate->templateImage;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('templateImage');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/template/', $filename);
            $invoiceTemplate->templateImage = $filename;
        }
        $invoiceTemplate->company = 'not company';
        $invoiceTemplate->update();
        return redirect()->to('/admin/manage/template/page')->with('message', 'Successfully Update Invoice Template.');
    }

    public function destroy($id)
    {
        $invoiceTemplate = InvoiceTemplate::findOrFail($id);
        $invoiceTemplate->delete();
        return redirect()->back()->with('message', 'Successfully Delete Invoice Template Package.');
    }

}
