<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentGetway;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\ComplateInvoiceCount;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],

        ]);
        if ($request->password_confirmation != $request->password) {
            return back()->with('message', 'Password Not match');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        // Create a new payment gateway record for the user
        PaymentGetway::create([
            'user_id' => $user->id,
            'amount' => '0',
            'subscription_package_id' => '1', // This is assumed to be the Free Plan
            'organization_package_id' => '0',
            'created_at' => Carbon::now()
        ]);
        // Create a new invoice count record for the user
        ComplateInvoiceCount::create([
            'user_id' => $user->id,
            'invoice_count_total' => '0',
            'current_invoice_total' => '0',
            'created_at' => Carbon::now()
        ]);

        // Create a new subscription record for the free plan
        $subscription_package = SubscriptionPackage::where('price', '0')->first(); // Assuming 1 is the ID for the Free Plan
        if (!$subscription_package) {
            return redirect()->back()->with('delete', 'Free plan not found. Please try again.');
        }

        Subscription::create([
            'user_id' => $user->id,
            'package_id' => $subscription_package->id,
            'name' => $subscription_package->packageName,
            'price' => $subscription_package->price,
            'invoice_template' => $subscription_package->templateQuantity,
            'invoice_generate' => $subscription_package->limitInvoiceGenerate,
            'duration' => $subscription_package->packageDuration,
            'status' => 1, // Active
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addDays($subscription_package->packageDuration),
        ]);


        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
