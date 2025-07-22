<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Exibe a página de login
     */
    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Processa o login para users ou admins
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|in:user,admin'
        ]);

        $credentials = $request->only('email', 'password');
        $userType = $request->input('user_type');
        $remember = $request->boolean('remember');

        // Tentar autenticação baseada no tipo de usuário
        if ($userType === 'admin') {
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        } else {
            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email', 'user_type');
    }

    /**
     * Processa o logout
     */
    public function logout(Request $request)
    {
        // Verifica qual guard está autenticado e faz logout
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Retorna o usuário autenticado (user ou admin)
     */
    public function user(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return response()->json([
                'user' => Auth::guard('admin')->user(),
                'type' => 'admin'
            ]);
        } elseif (Auth::guard('web')->check()) {
            return response()->json([
                'user' => Auth::guard('web')->user(),
                'type' => 'user'
            ]);
        }

        return response()->json(['user' => null, 'type' => null]);
    }
}