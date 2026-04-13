<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('shop_id', auth()->user()->shop_id)->get();
        return view('owner.users.index', compact('users'));
    }
}
