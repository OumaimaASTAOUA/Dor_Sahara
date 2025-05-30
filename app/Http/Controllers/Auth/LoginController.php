<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            Log::info('Login attempt:', ['email' => $request->email]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Log::info('User logged in successfully:', ['user_id' => Auth::id()]);

                if (Auth::user()->is_admin) {
                    return redirect()->route('admin.restaurant.index')->with('success', 'Bienvenue, vous êtes connecté en tant qu\'administrateur !');
                }

                return redirect()->route('dashboard')->with('success', 'Connexion réussie !');
            }

            Log::warning('Failed login attempt:', ['email' => $request->email]);
            return back()->withErrors([
                'email' => 'L\'email ou le mot de passe est incorrect.',
            ])->onlyInput('email');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error during login:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Login error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Une erreur s\'est produite lors de la connexion. Veuillez réessayer.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }
}
