<x-guest-layout>
    <div class="mb-6 text-center">
        
        <h1 class="mt-6 text-2xl font-bold text-gray-900">
            エンタメログにログイン
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            登録したエンタメ作品やタイムラインを確認できます。
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
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
                autocomplete="current-password"
                placeholder="パスワードを入力" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    ログイン状態を保持する
                </span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 shadow-sm">
                ログイン
            </button>
        </div>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 hover:underline"
                href="{{ route('password.request') }}">
                パスワードを忘れた方はこちら
            </a>
            @endif
        </div>

        <div class="mt-6 pt-6 border-t text-center">
            <p class="text-sm text-gray-500 mb-3">
                アカウントをお持ちでない方
            </p>

            <a href="{{ route('register') }}"
                class="inline-block w-full px-4 py-3 border border-indigo-300 text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50">
                アカウントを作成する
            </a>
        </div>
    </form>
</x-guest-layout>