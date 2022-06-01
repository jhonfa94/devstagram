<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd($request->remember);
        $request->validate([
            // 'email' => 'required|email|exists:users,email',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales incorrectas');
        }
        // dd('Autenticando...');
        return redirect()->route('post.index', auth()->user()->username);
    }
}
