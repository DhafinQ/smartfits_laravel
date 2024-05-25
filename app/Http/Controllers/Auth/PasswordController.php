<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::find($request->user_id);
        if(!empty($user->name)){
            $validated = $request->validate([
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
            $user->update([
                'password' => Hash::make($validated['password'])
            ]);
        }else{
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return back()->with('status', 'password-updated');
    }
}
