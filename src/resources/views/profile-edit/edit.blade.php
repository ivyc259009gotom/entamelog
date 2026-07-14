<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('profile.update.custom') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block font-medium text-gray-700">
                                ユーザー名
                            </label>

                            <input type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required>
                        </div>

                        <div>
                            <label for="bio" class="block font-medium text-gray-700">
                                自己紹介
                            </label>

                            <textarea id="bio"
                                name="bio"
                                rows="5"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="好きな作品や、よく見るジャンルなどを書いてみましょう。">{{ old('bio', $user->bio) }}</textarea>

                            <p class="mt-1 text-sm text-gray-500">
                                1000文字以内で入力してください。
                            </p>
                        </div>

                        <div>
                            <label for="profile_image" class="block font-medium text-gray-700">
                                プロフィール画像
                            </label>

                            <input type="file"
                                id="profile_image"
                                name="profile_image"
                                accept="image/*"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            <p class="mt-1 text-sm text-gray-500">
                                JPG、PNGなどの画像ファイルを選択できます。最大2MBまでです。
                            </p>
                        </div>

                        <div>
                            <p class="block font-medium text-gray-700 mb-2">
                                プレビュー
                            </p>

                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border">
                                <div class="rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-xl font-bold text-gray-500 flex-shrink-0"
                                    style="width: 72px; height: 72px;">
                                    @if ($user->profile_image_url)
                                    <img src="{{ $user->profile_image_url }}"
                                        alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    {{ mb_substr($user->name, 0, 1) }}
                                    @endif
                                </div>

                                <div>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $user->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $user->bio ?: '自己紹介はまだありません。' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                更新
                            </button>

                            <a href="{{ route('users.show', Auth::user()) }}"
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