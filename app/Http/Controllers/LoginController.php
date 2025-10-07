<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login', [
            'title' => 'Login',
        ]);
    }

    public function register()
    {
        return view('login.register', [
            'title' => 'Register',
        ]);
    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        User::create($validatedData);
        // $request->session()->flash('success', 'Registration Successfully! You can login now.');
        return redirect('/')->with('success', 'Registration Successfully! You can login now.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt($credentials)){ //pencocokan
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed! Please try again!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
