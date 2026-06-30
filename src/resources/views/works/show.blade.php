<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                作品詳細
            </h2>

            <a href="{{ route('works.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                一覧へ戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $work->title }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            登録日：{{ $work->created_at->format('Y年m月d日') }}
                        </p>
                    </div>

                    <div class="border-t pt-4 space-y-3">
                        <p>
                            <span class="font-semibold text-gray-700">種別：</span>
                            {{ $work->type }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700">ジャンル：</span>
                            {{ $work->genre ?: '未設定' }}
                        </p>

                        <div>
                            <span class="font-semibold text-gray-700">状況：</span>

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

                        <p>
                            <span class="font-semibold text-gray-700">評価：</span>

                            @if ($work->rating)
                                <span class="text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $work->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                            @else
                                未評価
                            @endif
                        </p>

                        <div>
                            <p class="font-semibold text-gray-700">感想・メモ：</p>

                            <div class="mt-2 p-4 bg-gray-50 rounded-md text-gray-800 text-left"
                                style="text-align: left; word-break: break-all;">
                                {{ $work->memo ?: 'メモはありません。' }}
                            </div>
                        </div>
                    </div>

                    @if ($work->user_id === Auth::id())
                        <div class="flex gap-3 border-t pt-4">
                            <a href="{{ route('works.edit', $work) }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
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
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>