<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $hasSearched = $keyword !== '';

        $users = collect();

        if ($keyword) {
            $users = User::query()
                ->where('id', '!=', Auth::id())
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('username', 'like', '%' . $keyword . '%');
                })
                ->latest()
                ->get();
        }

        return view('users.index', compact('users', 'keyword', 'hasSearched'));
    }

    public function show(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $works = $user->works()
            ->latest()
            ->get();

        return view('users.show', compact('user', 'works'));
    }
}