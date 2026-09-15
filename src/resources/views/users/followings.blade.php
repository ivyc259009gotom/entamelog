<x-app-layout>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            {{ $user->name }}さんがフォロー中のユーザー
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ '@' . $user->username }} さんがフォローしているユーザー一覧です。
                        </p>
                    </div>

                </div>
            </div>

            @if ($users->isEmpty())
            <div class="bg-white border border-dashed rounded-2xl p-10 text-center shadow-sm">
                <p class="text-gray-600 font-semibold">
                    まだフォロー中のユーザーはいません。
                </p>

                <p class="mt-2 text-sm text-gray-400">
                    ユーザー検索から気になるユーザーを探してフォローできます。
                </p>

                <a href="{{ route('users.index') }}"
                    class="inline-block mt-5 px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                    ユーザーを検索する
                </a>
            </div>
            @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($users as $followUser)
                <div class="bg-white border rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 min-w-0">
                            <div class="rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-lg font-bold text-gray-500 flex-shrink-0"
                                style="width: 64px; height: 64px; min-width: 64px;">
                                @if ($followUser->profile_image_url)
                                <img src="{{ $followUser->profile_image_url }}"
                                    alt="{{ $followUser->name }}"
                                    class="w-full h-full object-cover">
                                @else
                                {{ mb_substr($followUser->name, 0, 1) }}
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h4 class="text-lg font-bold text-gray-900 break-words">
                                    {{ $followUser->name }}
                                </h4>

                                @if ($followUser->username)
                                <p class="mt-1 text-sm text-gray-400">
                                    {{ '@' . $followUser->username }}
                                </p>
                                @endif

                                <p class="mt-2 text-sm text-gray-500 leading-relaxed"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $followUser->bio ?: 'エンタメログユーザー' }}
                                </p>

                                <p class="mt-2 text-sm text-gray-500">
                                    登録作品：{{ $followUser->works_count }}件
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 flex gap-3">
                        <a href="{{ route('users.show', $followUser->username) }}"
                            class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                            ユーザー詳細を見る
                        </a>

                        @if (Auth::id() !== $followUser->id)
                        @if (Auth::user()->isFollowing($followUser))
                        <form action="{{ route('follows.destroy', $followUser) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-4 py-2 border border-red-300 bg-white text-red-600 text-sm font-semibold rounded-lg hover:bg-red-50">
                                フォロー解除
                            </button>
                        </form>
                        @else
                        <form action="{{ route('follows.store', $followUser) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="px-4 py-2 border border-indigo-200 text-indigo-600 text-sm font-semibold rounded-lg hover:bg-indigo-50">
                                フォロー
                            </button>
                        </form>
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>