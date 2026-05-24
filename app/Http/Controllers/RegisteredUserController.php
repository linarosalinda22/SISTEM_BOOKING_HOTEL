<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'      => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/', 'max:15'],
            'address'    => ['required', 'string', 'max:500'],
            'ktp_number' => ['required', 'digits:16', 'unique:users,ktp_number'],
        ], [
            'phone.regex'        => 'Format nomor telepon tidak valid (contoh: 08123456789).',
            'ktp_number.digits'  => 'Nomor KTP harus terdiri dari 16 digit angka.',
            'ktp_number.unique'  => 'Nomor KTP sudah terdaftar.',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'tamu',   // ← otomatis 'tamu'
            'phone'      => $request->phone,
            'address'    => $request->address,
            'ktp_number' => $request->ktp_number,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('tamu.dashboard'));
    }
}