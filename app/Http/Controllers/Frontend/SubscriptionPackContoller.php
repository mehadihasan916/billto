<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentGetway;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use App\Models\ComplateInvoiceCount;
use Illuminate\Support\Facades\Auth;

class SubscriptionPackContoller extends Controller
{
    public function showAllPackages()
    {
        $packages = SubscriptionPackage::all();

        return view('frontend.packages.index', compact('packages'));
    }

    public function payment_gateway($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        $subscribe_package = SubscriptionPackage::where('id', $id)->get();

        $package_tamplate = DB::table('subscription_packages')
            ->join('subscription_package_templates', 'subscription_packages.id', '=', 'subscription_package_templates.subscriptionPackageId')
            ->join('invoice_templates', 'subscription_package_templates.template', '=', 'invoice_templates.id')
            ->where('subscription_packages.id', $id)->get();



        return view('payment_gatewaye.index', compact('subscribe_package', 'package_tamplate'));
    }

    public function payment_gateway_store(Request $request)
    {

        $request->validate([
            'package_price' => 'required',
            'package_id' => 'required',
            // 'auth_user_id'=>'required'
        ]);

        if (1 == $request->package_id) {
            return redirect()->back()->with('delete', 'Something went wrong. Please try again.');
        }

        $subscriptn_package =  SubscriptionPackage::where('id', $request->package_id)->first();

        // Check if package exists
        if (!$subscriptn_package) {
            return redirect()->back()->with('delete', 'Package not found. Please try again.');
        }

        // Handle free plan (price = 0)
        if ($subscriptn_package->price == '0' && $request->package_price == '0') {
            // For free plan, directly assign without payment processing
            PaymentGetway::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'amount' => $request->package_price,
                    'subscription_package_id' => $request->package_id,
                    'created_at' => Carbon::now(),
                ]
            );

            ComplateInvoiceCount::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'current_invoice_total' => '0',
                    'created_at' => Carbon::now()
                ]
            );

            return redirect()->back()->with('success', 'Free plan activated successfully! You can now create up to ' . $subscriptn_package->limitInvoiceGenerate . ' invoices per month.');
        }

        // Handle paid plans
        if ($subscriptn_package->price === $request->package_price) {

            PaymentGetway::where('user_id', auth()->user()->id)->update([
                'amount' => $request->package_price,
                'subscription_package_id' => $request->package_id,
                'created_at' => Carbon::now(),
            ]);

            ComplateInvoiceCount::where('user_id', auth()->user()->id)->update([
                'current_invoice_total' => '0',
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', ' Package succesfuly purchase. ');
        } else {
            return redirect()->back()->with('delete', 'Something went wrong. Please try again.');
        }
    }
}
