<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // dd($user);
        return redirect()->route('post.index')->with('success', 'User created successfully');
    }
}
