<?php

use App\Models\ComplateInvoiceCount;
use App\Models\PaymentGetway;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Socilite Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/{provider}/redirect', function ($provider) {

    return Socialite::driver($provider)->redirect();
});

Route::get('/auth/{provider}/callback', function ($provider) {

    try {
        $socialiteUser = Socialite::driver($provider)->user();
    } catch (\Throwable $th) {
        return redirect()->route('login');
    }


    $user = User::where([
        'provider' => $provider,
        'provider_id' => $socialiteUser->getId()
    ])->first();

    if (!$user) {

        $validator = Validator::make(
            ['email' => $socialiteUser->getEmail()],
            ['email' => ['unique:users,email']],
            ['email.unique' => 'Couldn\'t log in.  Maybe You used a different login method?']
        );

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator);
        }

        User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'email_verified_at' => now(),
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
        ]);


        $user = User::updateOrCreate(
            [
                'provider_id' => $socialiteUser->getId(),
            ],
            [
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'email_verified_at' => now(),
                'provider' => $provider,
                'provider_id' => $socialiteUser->getId(),
            ]
        );

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
    }


    Auth::login($user);

    return redirect('/');
});
