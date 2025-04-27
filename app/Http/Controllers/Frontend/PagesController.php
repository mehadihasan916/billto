<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\PaymentGetway;
use App\Models\InvoiceTemplate;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use App\Models\ComplateInvoiceCount;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        // Only for google, facebook & Github check request start
        if (Auth::check()) {
            $get_id =  Auth::user()->id;
            $user_id_check = PaymentGetway::where('user_id', $get_id)->count();

            if ($user_id_check == 0) {
                PaymentGetway::create([
                    'user_id' => $get_id,
                    'amount' => '0',
                    'subscription_package_id' => '1',
                    'organization_package_id' => '0',
                    'created_at' => Carbon::now()
                ]);
                ComplateInvoiceCount::create([
                    'user_id' => $get_id,
                    'invoice_count_total' => '0',
                    'current_invoice_total' => '0',
                    'created_at' => Carbon::now()
                ]);
            }
        }
        // Only for google, facebook & Github check request END

        $subcription_package_free = SubscriptionPackage::Where('packageName', 'FREE')->orWhere('packageName', 'Free')->get();
        $subcription_package_stand = SubscriptionPackage::Where('packageName', 'Standard')->orWhere('packageName', 'STANDARD')->get();
        $subcription_package_premium = SubscriptionPackage::Where('packageName', 'Premium')->orWhere('packageName', 'PREMIUM')->get();



        return view('frontend.home', compact('subcription_package_free', 'subcription_package_premium', 'subcription_package_stand'));
    }



    public function loadData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id) {
                $invoice_template = InvoiceTemplate::where('id', '>', $request->id)->limit('4')->get();
            } else {
                $invoice_template = InvoiceTemplate::limit(8)->get();
            }

            if ($request->id) {
                $invoice_template_not_com = InvoiceTemplate::where('id', '>', $request->id)->where('company', 'not company')->limit('4')->get();
            } else {
                $invoice_template_not_com = InvoiceTemplate::limit(8)->where('company', 'not company')->get();
            }

            return view('frontend.get-load-data', compact('invoice_template', 'invoice_template_not_com'));
        }
    }


    public function privacyPolicy()
    {
        return view('frontend.privacy-policy');
    }

    public function create()
    {
        return view('frontend.create_invoice');
    }

    public function createbill(Request $request)
    {
        return $request;
        return view('frontend.create_invoice');
    }
}
