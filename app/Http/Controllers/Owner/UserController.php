<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('shop_id', auth()->user()->shop_id)->get();
        return view('owner.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:cashier,staff',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
            'shop_id'  => auth()->user()->shop_id,
        ]);

        return redirect()->route('owner.users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        abort_if($user->shop_id !== auth()->user()->shop_id, 403);
        abort_if($user->id === auth()->id(), 403, 'Tidak dapat menghapus akun sendiri.');
        $user->delete();
        return redirect()->route('owner.users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
