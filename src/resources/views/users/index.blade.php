<x-app-layout>

    <style>
        @media (max-width: 640px) {
            .user-search-row {
                flex-direction: column;
                align-items: stretch;
            }

            .user-search-row input,
            .user-search-row button,
            .user-search-row a {
                width: 100% !important;
            }

            .user-result-card {
                flex-direction: column;
                align-items: stretch;
            }

            .user-result-info {
                align-items: flex-start;
            }

            .user-result-button {
                width: 100% !important;
                display: block;
                text-align: center;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            ユーザー検索
                        </h2>

                        <p class="mt-2 text-gray-600">
                            ユーザー名またはユーザーIDで、他のユーザーを検索できます。
                        </p>
                    </div>

                    <form action="{{ route('users.index') }}" method="GET" class="mb-6">
                        <div class="user-search-row flex items-center gap-3">
                            <input type="text"
                                name="keyword"
                                value="{{ $keyword ?? '' }}"
                                placeholder="ユーザー名またはユーザーIDで検索"
                                class="block w-full rounded-md border-gray-300 shadow-sm">

                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                                style="min-width: 80px; white-space: nowrap;">
                                検索
                            </button>

                            <a href="{{ route('users.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-center"
                                style="min-width: 80px; white-space: nowrap;">
                                クリア
                            </a>
                        </div>
                    </form>

                    @if (! $hasSearched)
                    {{-- 検索前は何も表示しない --}}
                    @elseif ($users->isEmpty())
                    <p class="text-gray-500">
                        ユーザーが見つかりませんでした。
                    </p>
                    @else
                    <div class="space-y-4">
                        @foreach ($users as $user)
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="user-result-card flex items-center justify-between gap-5">

                                <div class="user-result-info flex items-center gap-4 min-w-0">
                                    <div class="rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-lg font-bold text-gray-500 flex-shrink-0"
                                        style="width: 56px; height: 56px; min-width: 56px;">
                                        @if ($user->profile_image_url)
                                        <img src="{{ $user->profile_image_url }}"
                                            alt="{{ $user->name }}"
                                            class="w-full h-full object-cover">
                                        @else
                                        {{ mb_substr($user->name, 0, 1) }}
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 break-words">
                                            {{ $user->name }}
                                        </h3>

                                        @if ($user->username)
                                        <p class="text-sm text-gray-400 mt-1">
                                            {{ '@' . $user->username }}
                                        </p>
                                        @endif

                                        <p class="text-sm text-gray-500 mt-1 break-words"
                                            style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $user->bio ?: 'エンタメログユーザー' }}
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            登録作品：{{ $user->works->count() }}件
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('users.show', $user->username) }}"
                                    class="user-result-button px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                                    style="white-space: nowrap;">
                                    ユーザー詳細を見る
                                </a>

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