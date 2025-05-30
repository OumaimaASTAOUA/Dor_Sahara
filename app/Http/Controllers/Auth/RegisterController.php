<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'nullable|string|max:20',
                'password' => 'required|string|min:8|confirmed',
                'payment_method' => 'required|in:1,2,3,4',
            ]);

            Log::info('Validated registration data:', $validated);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'payment_method' => $validated['payment_method'],
                'is_admin' => 0,
            ]);

            Log::info('User created successfully:', $user->toArray());

            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error during registration:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.');
        }
    }
}
