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

                    <div class="mb-8 flex items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold text-gray-500 flex-shrink-0"
                                style="width: 64px; height: 64px;">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>

                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    {{ $user->name }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    エンタメログユーザー
                                </p>
                            </div>
                        </div>

                        <div>
                            @if (Auth::user()->isFollowing($user))
                            <form action="{{ route('follows.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 border border-red-300 bg-white text-red-600 rounded-md hover:bg-red-50"
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

                    <div class="mt-12 pt-6 border-t mb-5 flex items-center gap-2">
                        <h4 class="text-xl font-bold text-gray-900">
                            登録作品
                        </h4>

                        <span class="text-sm text-gray-500">
                            {{ $works->count() }}件
                        </span>
                    </div>

                    @if ($works->isEmpty())
                    <p class="text-gray-500">
                        まだ作品が登録されていません。
                    </p>
                    @else
                    <div class="grid gap-4 md:grid-cols-2">
                        @foreach ($works as $work)
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
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

                                <div class="flex-1 min-w-0">
                                    <div class="mb-3">
                                        <h5 class="text-lg font-bold text-gray-900 break-words">
                                            {{ $work->title }}
                                        </h5>

                                        <p class="text-sm text-gray-500 mt-2">
                                            <span class="font-semibold text-gray-600">種別：</span>{{ $work->type }}

                                            @if ($work->genre)
                                            <span class="mx-1 text-gray-300">／</span>
                                            <span class="font-semibold text-gray-600">ジャンル：</span>
                                            <span class="text-teal-600 hover:underline">
                                                {{ $work->genre }}
                                            </span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="text-sm text-gray-700 space-y-2">
                                        <div>
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

                                        <div>
                                            <span class="font-semibold text-gray-700">評価：</span>

                                            @if ($work->rating)
                                            <span class="text-yellow-500">
                                                {{ str_repeat('★', $work->rating) }}{{ str_repeat('☆', 5 - $work->rating) }}
                                            </span>
                                            @else
                                            <span class="text-gray-400">未評価</span>
                                            @endif
                                        </div>

                                        @if ($work->memo)
                                        <p class="mt-3 text-gray-600">
                                            {{ $work->memo }}
                                        </p>
                                        @endif
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('works.show', $work) }}"
                                            class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-700">
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
    </div>
</x-app-layout>