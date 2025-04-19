<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SendMail_info;
use Illuminate\Support\Facades\Auth;

class SettignsController extends Controller
{
    public function Settign()
    {
        return view('frontend.settings');
    }
    public function DefaultSetting()
    {
        return view('frontend.default-setting');
    }
    public function Myallinvoice()
    {
        $invoicessData = Invoice::where('user_id', Auth::user()->id)->get(['id', 'invoice_to', 'invoice_id', 'invoice_date', 'total','invoice_status','template_name','currency']);

        $user_id = Auth::user()->id;
        $all_Invoice_Count = Invoice::where('user_id',$user_id)->whereIn('status_due_paid',['paid','due'])->count();
        $sendByMail_count = SendMail_info::where('user_id', $user_id)->count();
        $Total_Amount_conut = Invoice::where('user_id',$user_id)->where('invoice_status','complete')->sum('final_total');
        $paid_Total_Amount_conut = Invoice::where('user_id',$user_id)->where('invoice_status','complete')->sum('receive_advance_amount');
        $due_Total_Amount_conut = Invoice::where('user_id',$user_id)->where('invoice_status','complete')->sum('balanceDue_amounts');
        $allInvoiceDatas = Invoice::where('user_id', Auth::user()->id)->whereIn('status_due_paid',['due','paid'])->orderBy('id', 'DESC')->paginate(10);

        $latestDataInvoices = Invoice::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(7)->get();

        return view('frontend.dashboard.home')
        ->with(compact('invoicessData',
        'latestDataInvoices','all_Invoice_Count',
        'sendByMail_count','Total_Amount_conut',
        'allInvoiceDatas','due_Total_Amount_conut','paid_Total_Amount_conut'));
    }

    public function MyTrashinvoice()
    {

     $invoicessData = Invoice::where('user_id', Auth::user()->id)->where('status_due_paid','draft')->get(['id', 'invoice_to', 'invoice_id', 'invoice_date', 'total','invoice_status','template_name','currency','currency']);
     return view('frontend.dashboard.invoice_trast')->with(compact('invoicessData'));
    }
}
