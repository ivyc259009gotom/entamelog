<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                エンタメログ
            </h2>

            <a href="{{ route('works.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                作品を登録
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('works.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center gap-3">
                            <input type="text"
                                name="keyword"
                                value="{{ $keyword ?? '' }}"
                                placeholder="作品タイトルで検索"
                                class="block w-full rounded-md border-gray-300 shadow-sm">

                            <select name="type"
                                class="rounded-md border-gray-300 shadow-sm"
                                style="min-width: 140px;">
                                <option value="">すべての種別</option>
                                <option value="映画" @selected(($type ?? '' )==='映画' )>映画</option>
                                <option value="ドラマ" @selected(($type ?? '' )==='ドラマ' )>ドラマ</option>
                                <option value="アニメ" @selected(($type ?? '' )==='アニメ' )>アニメ</option>
                                <option value="本" @selected(($type ?? '' )==='本' )>本</option>
                                <option value="ゲーム" @selected(($type ?? '' )==='ゲーム' )>ゲーム</option>
                                <option value="その他" @selected(($type ?? '' )==='その他' )>その他</option>
                            </select>

                            <select name="status"
                                class="rounded-md border-gray-300 shadow-sm"
                                style="min-width: 140px;">
                                <option value="">すべての状況</option>
                                <option value="気になる" @selected(($status ?? '' )==='気になる' )>気になる</option>
                                <option value="進行中" @selected(($status ?? '' )==='進行中' )>進行中</option>
                                <option value="完了" @selected(($status ?? '' )==='完了' )>完了</option>
                                <option value="中断" @selected(($status ?? '' )==='中断' )>中断</option>
                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                                style="min-width: 80px; white-space: nowrap;">
                                検索
                            </button>

                            <a href="{{ route('works.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-center"
                                style="min-width: 80px; white-space: nowrap;">
                                クリア
                            </a>
                        </div>
                    </form>

                    @if ($keyword || $type || $status || $genre)
                    <div class="mt-4 mb-6 px-4 py-3 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-800">
                        <span class="font-semibold">現在の絞り込み：</span>

                        @if ($keyword)
                        <span class="inline-block mr-3">
                            キーワード：{{ $keyword }}
                        </span>
                        @endif

                        @if ($type)
                        <span class="inline-block mr-3">
                            種別：{{ $type }}
                        </span>
                        @endif

                        @if ($status)
                        <span class="inline-block mr-3">
                            状況：{{ $status }}
                        </span>
                        @endif

                        @if ($genre)
                        <span class="inline-block mr-3">
                            ジャンル：{{ $genre }}
                        </span>
                        @endif
                    </div>
                    @endif

                    @if ($works->isEmpty())
                    <p class="text-gray-600">
                        まだ作品が登録されていません。
                    </p>
                    @else
                    <div class="grid gap-4 md:grid-cols-2">
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
                                    <h3 class="text-xl font-bold text-gray-900 break-words">
                                        {{ $work->title }}
                                    </h3>

                                    <p class="text-sm text-gray-600 mt-1">
                                        種別：{{ $work->type }}
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
                                        @else
                                        <span class="inline-block px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                            {{ $work->status }}
                                        </span>
                                        @endif
                                    </div>

                                    @if ($work->genre)
                                    <p class="text-sm text-gray-600 mt-1">
                                        ジャンル：{{ $work->genre }}
                                    </p>
                                    @endif

                                    @if ($work->rating)
                                    <p class="text-sm text-gray-600 mt-1">
                                        評価：
                                        <span class="text-yellow-500">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <=$work->rating)
                                                ★
                                                @else
                                                ☆
                                                @endif
                                                @endfor
                                        </span>
                                    </p>
                                    @endif

                                    @if ($work->memo)
                                    <p class="text-sm text-gray-700 mt-2"
                                        style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $work->memo }}
                                    </p>
                                    @endif

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <a href="{{ route('works.show', $work) }}"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                                            style="white-space: nowrap;">
                                            詳細
                                        </a>

                                        <a href="{{ route('works.edit', $work) }}"
                                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                            style="white-space: nowrap;">
                                            編集
                                        </a>

                                        <form action="{{ route('works.destroy', $work) }}" method="POST"
                                            onsubmit="return confirm('この作品を削除しますか？');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                                style="white-space: nowrap;">
                                                削除
                                            </button>
                                        </form>
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