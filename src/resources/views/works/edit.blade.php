<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            作品編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">
                            作品情報を編集する
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            視聴状況、評価、感想メモなどを更新できます。
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

                    <form action="{{ route('works.update', $work) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                作品タイトル
                            </label>
                            <input type="text" name="title" value="{{ old('title', $work->title) }}"
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
                                <option value="映画" @selected(old('type', $work->type) === '映画')>映画</option>
                                <option value="ドラマ" @selected(old('type', $work->type) === 'ドラマ')>ドラマ</option>
                                <option value="アニメ" @selected(old('type', $work->type) === 'アニメ')>アニメ</option>
                                <option value="本" @selected(old('type', $work->type) === '本')>本</option>
                                <option value="ゲーム" @selected(old('type', $work->type) === 'ゲーム')>ゲーム</option>
                                <option value="その他" @selected(old('type', $work->type) === 'その他')>その他</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                ジャンル
                            </label>
                            <input type="text" name="genre" value="{{ old('genre', $work->genre) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                状況
                            </label>
                            <select name="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required>
                                <option value="">選択してください</option>
                                <option value="観たい" @selected(old('status', $work->status) === '観たい')>観たい</option>
                                <option value="視聴中" @selected(old('status', $work->status) === '視聴中')>視聴中</option>
                                <option value="完了" @selected(old('status', $work->status) === '完了')>完了</option>
                                <option value="中断" @selected(old('status', $work->status) === '中断')>中断</option>
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
                                    <option value="{{ $i }}" @selected(old('rating', $work->rating) == $i)>
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
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('memo', $work->memo) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                画像URL
                            </label>

                            <input type="url"
                                name="image_url"
                                value="{{ old('image_url', $work->image_url) }}"
                                placeholder="https://example.com/image.jpg"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                            <p class="mt-1 text-sm text-gray-500">
                                作品画像のURLを入力できます。未入力でも保存できます。
                            </p>

                            @error('image_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                更新
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