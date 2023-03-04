<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Show login page
    public function index() {
        $titlename = "Login";
        if(Auth::guest()){
            Redirect::setIntendedUrl(url()->previous());
            return view('auth.index', compact('titlename'));
        } else {
            return redirect()->intended(RouteServiceProvider::DASHBOARD)->with('success', 'You are already logged in!');
        }
    }

    // Authenticate a user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::DASHBOARD)->with('success', 'You are now logged in!');
        }
        return back()->with(['error' => 'Credentials does not match in our database.'])->withInput($request->except('password'));
    }

    //Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login')->with('success', "You have been successfully logged out!");
    }
}
