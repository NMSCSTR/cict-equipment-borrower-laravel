<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ItemRequest;
use App\Models\BorrowTransaction;
use App\Models\Equipment;

class AuthenticateUser extends Controller
{
    //
    public function adminView()
    {
        return view('admin.dashboard');
    }


    public function borrowerView()
    {
        $userId = Auth::id();
        $requests = ItemRequest::where('user_id', $userId)->with('equipment')->get();
        $transactions = BorrowTransaction::where('user_id', $userId)->with('equipment')->get();
        $equipments = Equipment::all();
        return view('borrower.dashboard', compact('requests', 'transactions', 'equipments'));
    }

    public function studentView()
    {
        return view('student.dashboard');
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
            $request->session()->flash('welcome', 'Welcome back, ' . $user->name . '!');

            if ($user->user_type === 'Admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('borrower.dashboard'));
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
            'user_type' => 'required|in:Admin,Instructor,Student',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact_number' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'user_type' => $validatedData['user_type'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'contact_number' => $validatedData['contact_number'] ?? null,
        ]);

        return redirect()->back()->with('success', 'User added successfully!');

    }
}
