<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredEmail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::ROLE_CUSTOMER,
        ]);

        event(new Registered($user));

        Mail::to($user->email)->send(new UserRegisteredEmail($user)); //FIXME change to event listener

        Auth::login($user);

        if($user->role == UserRoleEnum::ROLE_CUSTOMER && session()->has('cart')) {
            return redirect()->route('checkout.index');
        }

        if($user->role == UserRoleEnum::ROLE_CUSTOMER) {
            return redirect()->route('front.store');
        }

        if($user->role == UserRoleEnum::ROLE_OWNER) {
            return redirect()->route('admin.dashboard');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
