<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user intended to visit a specific URL before being redirected to login
        if ($request->has('intended')) {
            session(['url.intended' => $request->intended]);
        }

        return view('pages.auth.login-attendance'); // Ensure this points to the correct view file
    }

    public function authenticate(Request $request)
    {
        $credentials = ['password' => $request->password];

        if (filter_var($request->useremail, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->useremail;
        } else {
            $credentials['username'] = $request->useremail;
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $request->session()->put('user', $user);
            $currentRoute = $request->route()->getName();
            info('Current Route: ' . $currentRoute);

            // Redirect to the intended URL after login or default to home
            return redirect(to:'/');
        }

        return back()->with('error', 'Email atau Password salah');
    }
    public function authenticateAttendance(Request $request)
    {
        $credentials = ['password' => $request->password];

        if (filter_var($request->useremail, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->useremail;
        } else {
            $credentials['username'] = $request->useremail;
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $request->session()->put('user', $user);
            $currentRoute = $request->route()->getName();
            info('Current Route: ' . $currentRoute);

            // Redirect to the intended URL after login or default to home
            return redirect(to:'/scan-qr');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
