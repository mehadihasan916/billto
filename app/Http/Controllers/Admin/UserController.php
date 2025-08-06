<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionExpired;
use App\Models\ComplateInvoiceCount;
use App\Models\PaymentGetway;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['subscription', 'used_invoices'])->where('is_admin', 0)->get();
        // dd($users);

        return view('admin.users.users', compact('users'));
    }
    //edit user
    public function edit($id)
    {
        $user = User::with('subscription')->findOrFail($id);
        $packages = SubscriptionPackage::all();
        // dd($user);
        return view('admin.users.edit-user', compact('user', 'packages'));
    }
    //update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($request->all());
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'terms' => $request->terms,
            'email_verified_at' => $request->email_verified_at ? now() : null,
        ];


        $user->fill($request->except(['picture', 'signature']));


        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Remove old image if exists
            if ($user->picture__input && file_exists(public_path('uploads/userImage/' . $user->picture__input))) {
                unlink(public_path('uploads/userImage/' . $user->picture__input));
            }
            $picture = $request->file('picture');
            $pictureName = uniqid() . '_' . time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('uploads/userImage'), $pictureName);
            $data['picture__input'] = $pictureName;
        }

        // Handle signature upload
        if ($request->hasFile('signature')) {
            // Remove old signature if exists
            if ($user->signature && file_exists(public_path('uploads/signature/' . $user->signature))) {
                unlink(public_path('uploads/signature/' . $user->signature));
            }
            $signature = $request->file('signature');
            $signatureName = uniqid() . '_' . time() . '.' . $signature->getClientOriginalExtension();
            $signature->move(public_path('uploads/signature'), $signatureName);
            $data['signature'] = $signatureName;
        }

        $old_package_id = $user->subscription ? $user->subscription->package_id : null;

        // subscription update
        if ($user->subscription->invoice_generate != $request->invoice_limit) {
            $subscription = Subscription::where('id', $user->subscription->id)->first();
            $subscription->update([
                'invoice_generate' => $request->invoice_limit,
            ]);
        }
        // Update end date if provided
        if (Carbon::parse($request->end_date) != $user->subscription->ends_at) {
            $subscription = Subscription::where('id', $user->subscription->id)->first();
            $endDate = Carbon::parse($request->end_date);
            $subscription->update([
                'ends_at' => $endDate,
            ]);
        }


        $this->assignSubscription($request->package, $user->id, $old_package_id);

        // dd($request->all());

        // Update user data
        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function assignSubscription($packages_id, $user_id, $old_package_id = null)
    {
        $subscription_package = SubscriptionPackage::where('id', $packages_id)->first(); // Assuming 1 is the ID for the Free Plan
        if (!$subscription_package) {
            return redirect()->back()->with('delete', 'Free plan not found. Please try again.');
        }

        // Create a new payment gateway record for the user
        PaymentGetway::updateOrCreate(
            ['user_id' => $user_id],
            [
                'amount' => $subscription_package->price,
                'subscription_package_id' => $packages_id,
                'organization_package_id' => '0',
                'stripe_id' => null, // Assuming no Stripe ID for this operation
                'created_at' => Carbon::now(),
            ]
        );
        // Create a new invoice count record for the user
        ComplateInvoiceCount::updateOrCreate(
            ['user_id' => $user_id],
            [
                'current_invoice_total' => 0,
                'invoice_count_total' => 0,
                'created_at' => Carbon::now(),
            ]
        );

        // if old old_package_id = new package_id than return or not create new subscription
        if (!$old_package_id || $old_package_id != $packages_id) {
            Subscription::create([
                'user_id' => $user_id,
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
    }

    //send expired notification
    public function sendExpiredMail($id)
    {
        $user = User::with('subscription')->findOrFail($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        // dd($user);

        // Send the subscription expired email
        Mail::to($user->email)->send(new SubscriptionExpired($user));

        return redirect()->back()->with('success', 'Expired notification sent successfully.');
    }

    //delete user
    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'You cannot delete an admin user.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
