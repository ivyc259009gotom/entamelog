<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        if ($user->id === Auth::id()) {
            abort(403);
        }

        Auth::user()->followings()->syncWithoutDetaching([$user->id]);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'フォローしました。');
    }

    public function destroy(User $user)
    {
        Auth::user()->followings()->detach($user->id);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'フォローを解除しました。');
    }
}