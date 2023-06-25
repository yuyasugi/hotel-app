<x-guests-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('送信完了') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    送信が完了しました！
                </div>
                <div>
                    <a href="/top" type="button" class="btn btn-outline-success m-3">TOPへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</x-guests-layout>
