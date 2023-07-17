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
        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($plans as $Plan)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="card-header bg-success d-flex align-items-center">
                        {{ $Plan->title }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="ml-5 mt-3">
                            {{-- ここで画像を表示 --}}
                            <div class="d-flex flex-wrap">
                                @foreach ($Plan->images as $image)
                                    <img src="{{ asset('images/' . $image->filename) }}" alt="Plan Image" width="300" class="mr-3 mb-3">
                                @endforeach
                            </div>
                            <label for="content">【プラン紹介】</label>
                            <p>{{ $Plan->content }}</p>
                            <label for="price">【ご料金】</label>
                            <p>{{ $Plan->cheapest_price }}円〜</p>
                        </div>
                        <div class="d-flex row justify-content-end mr-3">
                            <div>
                                <a href="{{ route('admin_plan_edit', $Plan->id) }}" class="btn btn-outline-success mr-2">編集</a>
                                <input type="hidden" name="id" value="{{ $Plan->id }}">
                            </div>
                            <div>
                                <form class="admin_plan_destroy" method="POST"
                                    action="{{ route('admin_plan_destroy', $Plan->id) }}"> @csrf
                                    <input type="hidden" name="id" value="{{ $Plan->id }}">
                                    <button type="submit" class="btn btn-outline-danger" onclick='return confirm("本当に削除しますか？")'>削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
