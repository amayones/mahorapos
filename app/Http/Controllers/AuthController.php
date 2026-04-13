<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        return redirect($this->roleRedirect(Auth::user()->role));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
            'shop_name' => 'required|string|max:100',
        ]);

        $shop = Shop::create([
            'name'                  => $data['shop_name'],
            'subscription_status'   => 'active',
            'subscription_end_date' => now()->addDays(30),
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'owner',
            'shop_id'  => $shop->id,
        ]);

        $shop->update(['owner_id' => $user->id]);

        Auth::login($user);

        return redirect('/owner/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function roleRedirect(string $role): string
    {
        return match ($role) {
            'owner'   => '/owner/dashboard',
            'cashier' => '/cashier/dashboard',
            'staff'   => '/staff/dashboard',
            'admin'   => '/admin/dashboard',
            default   => '/',
        };
    }
}
