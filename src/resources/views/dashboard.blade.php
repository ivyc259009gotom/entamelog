<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900">
                        エンタメログへようこそ
                    </h3>

                    <p class="mt-2 text-gray-600">
                        映画・ドラマ・アニメ・本・ゲームなどのエンタメ作品を記録できます。
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('works.index') }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            作品一覧を見る
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>