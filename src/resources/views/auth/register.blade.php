<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">
            アカウントを作成
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            エンタメ作品を記録して、自分だけのエンタメログを作りましょう。
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="ユーザー名" />
            <x-text-input id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="表示名を入力" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" value="ユーザーID" />

            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    @
                </span>

                <x-text-input id="username"
                    class="block w-full rounded-l-none"
                    type="text"
                    name="username"
                    :value="old('username')"
                    required
                    autocomplete="username"
                    placeholder="例：user_name" />
            </div>

            <p class="mt-1 text-sm text-gray-500">
                半角英数字・ハイフン・アンダーバーが使えます。
            </p>

            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="email"
                placeholder="メールアドレスを入力" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="パスワード" />

            <x-text-input id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="パスワードを入力" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="パスワード確認" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="もう一度パスワードを入力" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 shadow-sm">
                登録する
            </button>
        </div>

        <div class="mt-6 pt-6 border-t text-center">
            <p class="text-sm text-gray-500 mb-3">
                すでにアカウントをお持ちの方
            </p>

            <a href="{{ route('login') }}"
                class="inline-block w-full px-4 py-3 border border-indigo-300 text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50">
                ログイン画面へ
            </a>
        </div>
    </form>
</x-guest-layout>