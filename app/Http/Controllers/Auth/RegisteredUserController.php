<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipe_aktivitas' => ['required','string'],
            'jenis_kelamin' => ['required','string'],
            'tgl_lahir' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'client',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $costumer = Customer::create([
            'user_id' => $user->_id,
            'tgl_lahir' => Carbon::parse($request->tgl_lahir)->setTimezone(config('app.timezone')),
            'tipe_aktivitas' => $request->tipe_aktivitas,
            'jekel' => $request->jenis_kelamin
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
