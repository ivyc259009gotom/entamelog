<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $status = $request->input('status');

        $works = Work::where('user_id', Auth::id())
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->get();

        return view('works.index', compact('works', 'keyword', 'type', 'status'));
    }

    public function create()
    {
        return view('works.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'genre' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:50'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'memo' => ['nullable', 'string'],
        ]);

        $validated['user_id'] = Auth::id();

        Work::create($validated);

        return redirect()
            ->route('works.index')
            ->with('success', '作品を登録しました。');
    }

    public function show(Work $work)
    {
        if ($work->user_id !== Auth::id()) {
            abort(403);
        }

        return view('works.show', compact('work'));
    }

    public function edit(Work $work)
    {
        if ($work->user_id !== Auth::id()) {
            abort(403);
        }

        return view('works.edit', compact('work'));
    }

    public function update(Request $request, Work $work)
    {
        if ($work->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'genre' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:50'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'memo' => ['nullable', 'string'],
        ]);

        $work->update($validated);

        return redirect()
            ->route('works.index')
            ->with('success', '作品を更新しました。');
    }

    public function destroy(Work $work)
    {
        if ($work->user_id !== Auth::id()) {
            abort(403);
        }

        $work->delete();

        return redirect()
            ->route('works.index')
            ->with('success', '作品を削除しました。');
    }
}