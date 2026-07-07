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
                            <input type="text" name="title" id="title" value="{{ old('title', $work->title) }}"
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
                                id="image_url"
                                value="{{ old('image_url', $work->image_url) }}"
                                placeholder="https://example.com/image.jpg"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                            <p class="mt-1 text-sm text-gray-500">
                                作品画像のURLを入力できます。未入力でも保存できます。
                            </p>

                            @error('image_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-3 flex items-center gap-3">
                                <button type="button"
                                    id="tmdb-search-button"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    TMDbで画像検索
                                </button>

                                <span id="tmdb-search-message" class="text-sm text-gray-500"></span>
                            </div>

                            <div id="selected-image-preview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">選択中の画像</p>

                                <div class="bg-gray-100 rounded-md overflow-hidden border"
                                    style="width: 120px; height: 180px;">
                                    <img id="selected-image-preview-img"
                                        src=""
                                        alt="選択中の画像"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div id="tmdb-search-results" class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3"></div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const imageUrlInput = document.getElementById('image_url');
            const searchButton = document.getElementById('tmdb-search-button');
            const messageArea = document.getElementById('tmdb-search-message');
            const resultsArea = document.getElementById('tmdb-search-results');
            const previewArea = document.getElementById('selected-image-preview');
            const previewImage = document.getElementById('selected-image-preview-img');

            function updatePreview(url) {
                if (url) {
                    previewImage.src = url;
                    previewArea.classList.remove('hidden');
                } else {
                    previewImage.src = '';
                    previewArea.classList.add('hidden');
                }
            }

            updatePreview(imageUrlInput.value);

            imageUrlInput.addEventListener('input', function() {
                updatePreview(imageUrlInput.value);
            });

            searchButton.addEventListener('click', async function() {
                const keyword = titleInput.value.trim();

                if (!keyword) {
                    alert('先に作品タイトルを入力してください。');
                    titleInput.focus();
                    return;
                }

                messageArea.textContent = '検索中...';
                resultsArea.innerHTML = '';

                try {
                    const response = await fetch(`/tmdb/search?keyword=${encodeURIComponent(keyword)}`);
                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'TMDb検索に失敗しました。');
                    }

                    if (data.message) {
                        throw new Error(data.message);
                    }

                    if (!Array.isArray(data) || data.length === 0) {
                        messageArea.textContent = '候補が見つかりませんでした。';
                        return;
                    }

                    messageArea.textContent = `${data.length}件の候補が見つかりました。`;

                    data.forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'border rounded-xl p-4 bg-white shadow-sm';

                        const mediaTypeLabel = item.media_type === 'tv' ? 'ドラマ / TV' : '映画';

                        card.innerHTML = `
                    <div class="bg-gray-100 rounded-md overflow-hidden border mx-auto"
                        style="width: 120px; height: 180px;">
                        ${item.poster_url
                            ? `<img src="${item.poster_url}" alt="${item.title}" class="w-full h-full object-cover">`
                            : `<div class="w-full h-full flex items-center justify-center text-xs text-gray-400 text-center px-2">No Image</div>`
                        }
                    </div>

                    <div class="mt-3">
                        <p class="text-xs text-gray-500">${mediaTypeLabel}</p>
                        <h4 class="font-bold text-gray-900 mt-1">${item.title || ''}</h4>
                        <p class="text-sm text-gray-500 mt-1">${item.release_date || ''}</p>
                    </div>

                    <button type="button"
                            class="mt-4 w-full px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 tmdb-select-button">
                        この画像を使う
                    </button>
                `;

                        const selectButton = card.querySelector('.tmdb-select-button');
                        selectButton.addEventListener('click', function() {
                            imageUrlInput.value = item.poster_url || '';
                            updatePreview(item.poster_url || '');
                            messageArea.textContent = '画像を選択しました。';
                            window.scrollTo({
                                top: imageUrlInput.offsetTop - 120,
                                behavior: 'smooth'
                            });
                        });

                        resultsArea.appendChild(card);
                    });

                } catch (error) {
                    console.error(error);
                    messageArea.textContent = error.message || '検索に失敗しました。';
                }
            });
        });
    </script>

</x-app-layout>