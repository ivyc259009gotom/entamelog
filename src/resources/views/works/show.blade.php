<x-app-layout>

    <style>
        @media (max-width: 640px) {
            .work-detail-header {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .work-detail-body {
                flex-direction: column;
                gap: 1.5rem !important;
            }

            .work-detail-info {
                width: 100%;
            }

            .work-detail-actions {
                flex-direction: column;
            }

            .work-detail-actions a,
            .work-detail-actions button {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="py-10 md:py-14">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="work-detail-header mb-8 flex items-center justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-900">
                    作品詳細
                </h2>

                <a href="{{ route('works.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                    style="white-space: nowrap;">
                    一覧へ戻る
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6 md:p-8 space-y-6">

                    <div class="mb-4">
                        <h3 class="font-bold text-gray-900 break-words"
                            style="font-size: 28px; line-height: 1.4;">
                            {{ $work->title }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            登録日：{{ $work->created_at->format('Y年m月d日') }}
                        </p>
                    </div>

                    <div class="border-t pt-6">
                        <div class="work-detail-body flex items-start" style="gap: 48px;">

                            <div class="bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border"
                                style="width: 150px; height: 225px;">
                                @if ($work->image_url)
                                <img src="{{ $work->image_url }}"
                                    alt="{{ $work->title }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-sm text-gray-400 text-center px-3">
                                    No Image
                                </div>
                                @endif
                            </div>

                            <div class="work-detail-info flex-1 min-w-0 space-y-4 pt-2">
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
                                    <span class="font-semibold text-gray-700">評価：</span>

                                    @if ($work->rating)
                                    <span class="text-yellow-500 whitespace-nowrap">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <=$work->rating)
                                            ★
                                            @else
                                            ☆
                                            @endif
                                            @endfor
                                    </span>
                                    @else
                                    <span class="text-gray-500">未評価</span>
                                    @endif
                                </p>

                                <div>
                                    <p class="font-semibold text-gray-700">
                                        感想・メモ：
                                    </p>

                                    <div class="mt-2 p-4 bg-gray-50 rounded-md text-gray-800 leading-relaxed break-words">
                                        {{ $work->memo ?: 'メモはありません。' }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @if ($work->user_id === Auth::id())
                    <div class="work-detail-actions flex justify-end gap-3 border-t pt-4">
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