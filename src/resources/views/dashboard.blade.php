<x-app-layout>

    <style>
        @media (max-width: 640px) {
            .home-welcome-row {
                flex-direction: column;
                align-items: stretch;
            }

            .home-welcome-button-wrap {
                width: 100%;
            }

            .home-welcome-button {
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <div class="bg-white border rounded-2xl px-10 py-9 shadow-sm">
                <div class="home-welcome-row flex items-center justify-between gap-10">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            エンタメログへようこそ
                        </h3>

                        <p class="mt-3 text-gray-600 leading-relaxed">
                            映画・ドラマ・アニメ・本・ゲームなどのエンタメ作品を記録し、他のユーザーの記録も見ることができます。
                        </p>
                    </div>

                    <div class="home-welcome-button-wrap flex-shrink-0">
                        <a href="{{ route('works.create') }}"
                            class="home-welcome-button inline-block px-5 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 shadow-sm">
                            作品を登録する
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white border rounded-2xl px-8 py-7 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        新着タイムライン
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        フォロー中ユーザーが追加した作品を確認できます。
                    </p>
                </div>

                @if ($timelineWorks->isEmpty())
                <div class="border border-dashed rounded-xl p-10 text-center bg-gray-50">
                    <p class="text-gray-600 font-semibold">
                        フォロー中ユーザーの投稿はまだありません。
                    </p>

                    <p class="mt-2 text-sm text-gray-400">
                        ユーザーをフォローすると、ここに新着作品が表示されます。
                    </p>

                    <a href="{{ route('users.index') }}"
                        class="inline-block mt-5 px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                        ユーザーを検索する
                    </a>
                </div>
                @else
                <div class="grid gap-4 md:grid-cols-2">
                    @foreach ($timelineWorks as $work)
                    <div class="border rounded-xl p-5 bg-white shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-sm font-bold text-gray-500 flex-shrink-0"
                                style="width: 44px; height: 44px;">
                                @if ($work->user->profile_image_url)
                                <img src="{{ $work->user->profile_image_url }}"
                                    alt="{{ $work->user->name }}"
                                    class="w-full h-full object-cover">
                                @else
                                {{ mb_substr($work->user->name, 0, 1) }}
                                @endif
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm text-gray-700">
                                    <a href="{{ route('users.show', $work->user->username) }}"
                                        class="font-bold text-gray-900 hover:underline">
                                        {{ $work->user->name }}
                                    </a>
                                    さんが追加しました
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    {{ $work->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="bg-gray-100 rounded-md overflow-hidden border"
                                    style="width: 96px; height: 144px;">
                                    @if ($work->image_url)
                                    <img src="{{ $work->image_url }}"
                                        alt="{{ $work->title }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-400 text-center px-2">
                                        No Image
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-gray-900 break-words">
                                    {{ $work->title }}
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $work->type }}

                                    @if ($work->genre)
                                    <span class="mx-1 text-gray-300">／</span>
                                    {{ $work->genre }}
                                    @endif
                                </p>

                                <div class="mt-2">
                                    @if ($work->status === '気になる')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        気になる
                                    </span>
                                    @elseif ($work->status === '進行中')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                        進行中
                                    </span>
                                    @elseif ($work->status === '完了')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        完了
                                    </span>
                                    @elseif ($work->status === '中断')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                        中断
                                    </span>
                                    @endif
                                </div>

                                <p class="mt-2 text-sm">
                                    @if ($work->rating)
                                    <span class="text-yellow-500">
                                        {{ str_repeat('★', $work->rating) }}{{ str_repeat('☆', 5 - $work->rating) }}
                                    </span>
                                    @else
                                    <span class="text-gray-400">未評価</span>
                                    @endif
                                </p>

                                @if ($work->memo)
                                <p class="mt-2 text-sm text-gray-600 leading-relaxed"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $work->memo }}
                                </p>
                                @endif

                                <div class="mt-4">
                                    <a href="{{ route('works.show', $work) }}"
                                        class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                                        作品詳細を見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>

</x-app-layout>