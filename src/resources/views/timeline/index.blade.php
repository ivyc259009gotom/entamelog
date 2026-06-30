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
                                <div class="border rounded-xl p-5 bg-white shadow-sm">
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-500 mb-1">
                                            {{ $work->user->name }} さんの登録作品
                                        </p>

                                        <h3 class="text-lg font-bold text-gray-900">
                                            {{ $work->title }}
                                        </h3>

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
                                            <p class="mt-3 text-gray-600 text-sm"
                                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $work->memo }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex items-center gap-4">
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
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>