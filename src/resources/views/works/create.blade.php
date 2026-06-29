<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            作品登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">
                            新しい作品を記録する
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            映画・ドラマ・アニメ・本・ゲームなど、気になっている作品や見終わった作品を登録できます。
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('works.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                作品タイトル
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                種別
                            </label>
                            <select name="type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required>
                                <option value="">選択してください</option>
                                <option value="映画" @selected(old('type') === '映画')>映画</option>
                                <option value="ドラマ" @selected(old('type') === 'ドラマ')>ドラマ</option>
                                <option value="アニメ" @selected(old('type') === 'アニメ')>アニメ</option>
                                <option value="本" @selected(old('type') === '本')>本</option>
                                <option value="ゲーム" @selected(old('type') === 'ゲーム')>ゲーム</option>
                                <option value="その他" @selected(old('type') === 'その他')>その他</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                ジャンル
                            </label>
                            <input type="text" name="genre" value="{{ old('genre') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="例：ファンタジー、恋愛、ミステリー">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                状況
                            </label>
                            <select name="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required>
                                <option value="">選択してください</option>
                                <option value="観たい" @selected(old('status') === '観たい')>観たい</option>
                                <option value="視聴中" @selected(old('status') === '視聴中')>視聴中</option>
                                <option value="完了" @selected(old('status') === '完了')>完了</option>
                                <option value="中断" @selected(old('status') === '中断')>中断</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                評価
                            </label>
                            <select name="rating"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">未評価</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @selected(old('rating') == $i)>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                感想・メモ
                            </label>
                            <textarea name="memo" rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="感想やメモを入力">{{ old('memo') }}</textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                登録
                            </button>

                            <a href="{{ route('works.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                キャンセル
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>