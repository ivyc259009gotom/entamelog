<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー検索
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <p class="text-gray-600 mb-6">
                        ユーザー名で、他のユーザーを検索できます。
                    </p>

                    <form action="{{ route('users.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center gap-3">
                            <input type="text"
                                name="keyword"
                                value="{{ $keyword ?? '' }}"
                                placeholder="ユーザー名で検索"
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

                    @if ($users->isEmpty())
                    <p class="text-gray-500">
                        ユーザーが見つかりませんでした。
                    </p>
                    @else
                    <div class="space-y-4">
                        @foreach ($users as $user)
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="rounded-full bg-gray-200 flex items-center justify-center text-lg font-bold text-gray-500 flex-shrink-0"
                                        style="width: 56px; height: 56px;">
                                        {{ mb_substr($user->name, 0, 1) }}
                                    </div>

                                    <div class="min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 break-words">
                                            {{ $user->name }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            エンタメログユーザー
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            登録作品：{{ $user->works->count() }}件
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('users.show', $user) }}"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
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