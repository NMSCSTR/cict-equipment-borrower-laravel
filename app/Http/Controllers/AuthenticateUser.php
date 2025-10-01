<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticateUser extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->user_type === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_type === 'instructor') {
                return redirect()->route('instructor.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        return back()->withErrors(['email' => 'The provided credentials do not match on our records'])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registerUser()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact_number' => 'nullable|string|max:15',
            'user_type' => 'required|in:admin,instructor,student',
        ]);

        $user = User::create([
            'user_type' => $validatedData['user_type'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'contact_number' => $validatedData['contact_number'] ?? null,
        ]);

        Auth::login($user);
        return redirect()->route('auth.welcome');


    }
}
