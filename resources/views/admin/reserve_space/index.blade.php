<x-app-layout>
    <x-slot name="header">
        <div class="d-flex">
            <div class="mr-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('予約枠一覧') }}
                </h2>
            </div>
            <div class="mr-4 d-flex text-right">
                <a type="button" class="btn btn-outline-success btn-sm mr-4"
                    href="{{ route('admin_reserve_space_create') }}">予約枠作成へ</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="card col-10 mx-auto">
            <div class="p-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">日付</th>
                            <th scope="col">部屋タイプ</th>
                            <th scope="col">残り部屋数</th>
                            <th scope="col">編集</th>
                            <th scope="col">削除</th>
                        </tr>
                    </thead>
                    @foreach ($ReserveSpaces as $ReserveSpace)
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $ReserveSpace->date }}</td>
                                <td>{{ $ReserveSpace->room->room_type }}</td>
                                <td>{{ $ReserveSpace->count }}</td>
                                <td>
                                    <a href="{{ route('admin_reserve_space_edit', $ReserveSpace->id) }}" class="btn btn-outline-secondary btn-sm mr-2">編集</a>
                                    <input type="hidden" name="id" value="{{ $ReserveSpace->id }}">
                                </td>
                                <td>
                                    <form class="admin_reserve_space_destroy" method="POST"
                                        action="{{ route('admin_reserve_space_destroy', $ReserveSpace->id) }}"> @csrf
                                        <input type="hidden" name="id" value="{{ $ReserveSpace->id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick='return confirm("本当に削除しますか？")'>削除</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
