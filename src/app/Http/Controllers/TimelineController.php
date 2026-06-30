<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index()
    {
        $followingIds = Auth::user()
            ->followings()
            ->pluck('users.id');

        $works = Work::with('user')
            ->whereIn('user_id', $followingIds)
            ->latest()
            ->get();

        return view('timeline.index', compact('works'));
    }
}