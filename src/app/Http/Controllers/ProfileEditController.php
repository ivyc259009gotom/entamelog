<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileEditController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile-edit.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image_url) {
                $oldPath = str_replace('/storage/', '', $user->profile_image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image_url = Storage::url($path);
        }

        $user->save();

        return redirect()
            ->route('profile.edit.custom')
            ->with('success', 'プロフィールを更新しました。');
    }
}
