<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
		       return redirect()->route('dashboard')
                ->with('success', 'Selamat datang!');
		    }
        return view('admin.pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang!');
        } else {
            return redirect()->route('login')
                ->with('error', 'Email atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        //
    }
}
