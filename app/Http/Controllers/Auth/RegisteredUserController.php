<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentGetway;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\ComplateInvoiceCount;
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

        event(new Registered($user));

        $get_id = $user->id;

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

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
