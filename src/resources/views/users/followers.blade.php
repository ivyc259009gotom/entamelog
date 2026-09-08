<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            フォロワー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            {{ $user->name }}さんのフォロワー
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ '@' . $user->username }} さんをフォローしているユーザー一覧です。
                        </p>
                    </div>

                    <a href="{{ route('users.show', $user->username) }}"
                        class="text-sm text-indigo-600 hover:underline">
                        プロフィールへ戻る →
                    </a>
                </div>
            </div>

            @if ($users->isEmpty())
            <div class="bg-white border border-dashed rounded-2xl p-10 text-center shadow-sm">
                <p class="text-gray-600 font-semibold">
                    まだフォロワーはいません。
                </p>

                <p class="mt-2 text-sm text-gray-400">
                    作品を登録したりプロフィールを充実させると、他のユーザーに見つけてもらいやすくなります。
                </p>

                <a href="{{ route('works.create') }}"
                    class="inline-block mt-5 px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                    作品を登録する
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
                        <span class="inline-block px-4 py-2 border border-gray-200 bg-gray-50 text-gray-500 text-sm font-semibold rounded-lg">
                            フォロー中
                        </span>
                        @else
                        <form action="{{ route('follows.store', $followUser) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="px-4 py-2 border border-indigo-200 text-indigo-600 text-sm font-semibold rounded-lg hover:bg-indigo-50">
                                @if (Auth::id() === $user->id)
                                フォローバックする
                                @else
                                フォローする
                                @endif
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