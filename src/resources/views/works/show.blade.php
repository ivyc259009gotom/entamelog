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

                        <p>
                            <span class="font-semibold text-gray-700">状況：</span>
                            {{ $work->status }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700">評価：</span>
                            @if ($work->rating)
                                {{ $work->rating }} / 5
                            @else
                                未評価
                            @endif
                        </p>

                        <div>
                            <p class="font-semibold text-gray-700">感想・メモ：</p>

                            <div class="mt-2 p-4 bg-gray-50 rounded-md text-gray-800 whitespace-pre-wrap">
                                {{ $work->memo ?: 'メモはありません。' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 border-t pt-4">
                        <a href="{{ route('works.edit', $work) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            編集
                        </a>

                        <form action="{{ route('works.destroy', $work) }}" method="POST"
                              onsubmit="return confirm('この作品を削除しますか？');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                削除
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>