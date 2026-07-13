<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タイムライン
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <p class="text-gray-600 mb-6">
                        フォロー中のユーザーが登録した作品を、新しい順に表示します。
                    </p>

                    @if ($works->isEmpty())
                    <div class="p-6 bg-gray-50 rounded-lg text-gray-600">
                        <p class="font-semibold">
                            まだタイムラインに表示できる作品がありません。
                        </p>

                        <p class="mt-2 text-sm">
                            ユーザー検索から他のユーザーをフォローすると、そのユーザーの登録作品がここに表示されます。
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('users.index') }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                ユーザー検索へ
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="space-y-4">
                        @foreach ($works as $work)
                        <div class="border rounded-xl p-5 bg-white shadow-sm hover:shadow-md transition">
                            <div class="flex gap-4 items-start">

                                <div class="bg-gray-100 rounded-md overflow-hidden flex-shrink-0 border"
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

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500 mb-1">
                                        {{ $work->user->name }} さんの登録作品
                                    </p>

                                    <h3 class="text-lg font-bold text-gray-900 break-words">
                                        {{ $work->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $work->type }}
                                        @if ($work->genre)
                                        ・{{ $work->genre }}
                                        @endif
                                    </p>

                                    <div class="text-sm text-gray-700 space-y-1 mt-3">
                                        <div class="mt-2">
                                            <span class="font-semibold text-gray-700">状況：</span>

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
                                            @else
                                            <span class="inline-block px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                {{ $work->status }}
                                            </span>
                                            @endif
                                        </div>

                                        <p>
                                            <span class="font-semibold">評価：</span>
                                            @if ($work->rating)
                                            {{ str_repeat('★', $work->rating) }}{{ str_repeat('☆', 5 - $work->rating) }}
                                            @else
                                            未評価
                                            @endif
                                        </p>

                                        @if ($work->memo)
                                        <p class="mt-3 text-gray-600 text-sm"
                                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $work->memo }}
                                        </p>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex flex-wrap gap-4">
                                        <a href="{{ route('works.show', $work) }}"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                                            作品詳細を見る
                                        </a>

                                        <a href="{{ route('users.show', $work->user) }}"
                                            class="text-gray-600 hover:text-gray-800 text-sm font-semibold">
                                            {{ $work->user->name }} さんのページを見る
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
    </div>
</x-app-layout>