<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\PaymentGetway;
use App\Models\SubscriptionPackage;
use App\Models\ComplateInvoiceCount;
use App\Models\PaymentRecord;
use App\Models\Subscription;
use Carbon\Carbon;

class StripeController extends Controller
{


    // Show payment form

    // Create PaymentIntent (for client-side confirmation)
    public function createIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        try {
            $intent = PaymentIntent::create([
                'amount' => floor($request->package_price) * 100, // $10.00 in cents
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);


            return response()->json([
                'clientSecret' => $intent->client_secret
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Handle successful payment (webhook would be better for production)
    public function processPayment(Request $request)
    {
        $request->validate([
            'package_price' => 'required',
            'package_id' => 'required',
            // 'auth_user_id'=>'required'
        ]);

        if (1 == $request->package_id) {
            return redirect()->back()->with('delete', 'Something went wrong. Please try again.');
        }

        $subscription_package =  SubscriptionPackage::where('id', $request->package_id)->first();


        if ($subscription_package) {

            PaymentGetway::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'amount' => $request->package_price,
                    'stripe_id' => $request->stripe_id,
                    'subscription_package_id' => $request->package_id,
                    'created_at' => Carbon::now(),
                ]
            );

            ComplateInvoiceCount::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'current_invoice_total' => 0,
                    'invoice_count_total' => 0,
                    'created_at' => Carbon::now(),
                ]
            );
            $records = PaymentRecord::create([
                'user_id' => auth()->id(),
                'order_id' => random_int(100000, 999999),
                'stripe_id' => $request->stripe_id,
                'package_id' => $request->package_id,
                'package_price' => $request->package_price,
                'package_name' => $request->package_name,
            ]);

            // Create a new subscription record
            Subscription::create([
                'user_id' => auth()->id(),
                'payment_record_id' => $records->id,
                'name' => $subscription_package->packageName,
                'price' => $subscription_package->price,
                'invoice_template' => $subscription_package->templateQuantity,
                'invoice_generate' => $subscription_package->limitInvoiceGenerate,
                'duration' => $subscription_package->packageDuration,
                'status' => 1, // Active
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays($subscription_package->packageDuration),
            ]);

            session([
                'package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'record' => $records,
            ]);
            session()->save();


            return response()->json([
                'success' => true,
                'redirect_url' => route('payment.success'),
            ]);
        }
    }

    public function success(Request $request)
    {
        // dd(session('record'));
        return view('frontend.payment.success')->with([
            'package_name' => session('package_name'),
            'package_price' => session('package_price'),
            'record' => session('record'),
        ]);
    }
}
