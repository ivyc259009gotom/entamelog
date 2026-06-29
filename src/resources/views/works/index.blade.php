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
                    @if ($works->isEmpty())
                        <p class="text-gray-600">
                            まだ作品が登録されていません。
                        </p>
                    @else
                        <div class="grid gap-4 md:grid-cols-2">
                            @foreach ($works as $work)
                                <div class="border rounded-xl p-5 bg-white shadow-sm hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">
                                                {{ $work->title }}
                                            </h3>

                                            <p class="text-sm text-gray-600 mt-1">
                                                種別：{{ $work->type }}
                                            </p>

                                            <div class="mt-2">
                                                @if ($work->status === '観たい')
                                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                        観たい
                                                    </span>
                                                @elseif ($work->status === '視聴中')
                                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                                        視聴中
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
                                                <p class="text-sm text-gray-600">
                                                    ジャンル：{{ $work->genre }}
                                                </p>
                                            @endif

                                            @if ($work->rating)
                                                <p class="text-sm text-gray-600">
                                                    評価：
                                                    <span class="text-yellow-500">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $work->rating)
                                                                ★
                                                            @else
                                                                ☆
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </p>
                                            @endif

                                            @if ($work->memo)
                                                <p class="text-sm text-gray-700 mt-2">
                                                    {{ $work->memo }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="flex gap-2">
                                            <a href="{{ route('works.show', $work) }}"
                                            class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                詳細
                                            </a>

                                            <a href="{{ route('works.edit', $work) }}"
                                            class="px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                                編集
                                            </a>

                                            <form action="{{ route('works.destroy', $work) }}" method="POST"
                                                onsubmit="return confirm('この作品を削除しますか？');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    削除
                                                </button>
                                            </form>
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