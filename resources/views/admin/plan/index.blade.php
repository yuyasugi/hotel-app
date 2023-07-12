<x-app-layout>
    <x-slot name="header">
        <div class="d-flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('宿泊プラン一覧') }}
                </h2>
            </div>
            <div class="ml-4 d-flex text-right">
                <a type="button" class="btn btn-outline-success btn-sm mr-4"
                    href="{{ route('admin_plan_create') }}">宿泊プラン作成へ</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($plans as $Plan)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="card-header bg-success d-flex align-items-center">
                        {{ $Plan->title }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="ml-5 mt-3">
                            {{-- ここで画像4枚表示 --}}
                            <label for="meal_state">【お食事】</label>
                            <p>{{ $Plan->meal_state }}</p>
                            <label for="content">【プラン紹介】</label>
                            <p>{{ $Plan->content }}</p>
                            <label for="price">【ご料金】</label>
                            <p>{{ $Plan->cheapest_price }}円〜</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
