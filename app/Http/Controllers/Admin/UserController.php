<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        $user = User::findOrFail($id);
        return view('admin.users.edit-user', compact('user'));
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

        // dd($data);

        // Update user data
        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
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
