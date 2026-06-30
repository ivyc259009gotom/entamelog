<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $user->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div>
                            @if (Auth::user()->isFollowing($user))
                                <form action="{{ route('follows.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                            style="white-space: nowrap;">
                                        フォロー解除
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('follows.store', $user) }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                                            style="white-space: nowrap;">
                                        フォロー
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            ユーザー検索へ戻る
                        </a>
                    </div>

                    <h4 class="text-lg font-bold text-gray-900 mb-4">
                        登録作品
                    </h4>

                    @if ($works->isEmpty())
                        <p class="text-gray-500">
                            まだ作品が登録されていません。
                        </p>
                    @else
                        <div class="grid gap-4 md:grid-cols-2">
                            @foreach ($works as $work)
                                <div class="border rounded-xl p-5 bg-white shadow-sm">
                                    <div class="mb-3">
                                        <h5 class="text-lg font-bold text-gray-900">
                                            {{ $work->title }}
                                        </h5>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $work->type }}
                                            @if ($work->genre)
                                                ・{{ $work->genre }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="text-sm text-gray-700 space-y-1">
                                        <p>
                                            <span class="font-semibold">状況：</span>
                                            {{ $work->status }}
                                        </p>

                                        <p>
                                            <span class="font-semibold">評価：</span>
                                            @if ($work->rating)
                                                {{ str_repeat('★', $work->rating) }}{{ str_repeat('☆', 5 - $work->rating) }}
                                            @else
                                                未評価
                                            @endif
                                        </p>

                                        @if ($work->memo)
                                            <p class="mt-3 text-gray-600">
                                                {{ $work->memo }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>