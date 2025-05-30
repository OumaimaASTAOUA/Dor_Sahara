<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ProfileController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Register Request Data:', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'payment_method' => 'required|in:0,1',
            'role' => 'required|string|in:user,admin',
        ]);

        Log::info('Validated Data:', $validated);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'payment_method' => (int) $validated['payment_method'],
            'role' => $validated['role'],
        ]);

        Log::info('User Created:', $user->toArray());

        return redirect()->route('login')->with('success', 'Compte créé avec succès');
    }
}
