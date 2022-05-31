<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|string|min:5|max:30',
            'username' => 'required|string|min:3|max:20|unique:users',
            'email' => 'required|string|email|max:80|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }
}
