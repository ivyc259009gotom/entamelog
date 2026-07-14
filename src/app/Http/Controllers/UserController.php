<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::query()
            ->where('id', '!=', Auth::id())
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->get();

        return view('users.index', compact('users', 'keyword'));
    }

    public function show(User $user)
    {
        $works = $user->works()
            ->latest()
            ->get();

        return view('users.show', compact('user', 'works'));
    }
}