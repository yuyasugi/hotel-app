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
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
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
                        <th scope="col">予約状況</th>
                        <th scope="col">削除</th>
                    </tr>
                </thead>
                @foreach ($ReserveSpaces as $ReserveSpace)
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $ReserveSpace->date }}</td>
                            <td>{{ $ReserveSpace->room->room_type }}</td>
                            <td>
                                @if ($ReserveSpace->reserve_flag === 0)
                                    <form class="admin_inquiry_update"
                                        action="{{ route('admin_reserve_space_update', $ReserveSpace->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn btn-outline-success btn-sm" name="id"
                                                value="{{ $ReserveSpace->id }}">予約可</button>
                                        </div>
                                    </form>
                                @else
                                    <form class="admin_inquiry_update"
                                        action="{{ route('admin_reserve_space_update', $ReserveSpace->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-secondary active btn-sm"
                                                name="id" value="{{ $ReserveSpace->id }}">予約済み</button>
                                        </div>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form class="admin_reserve_space_destroy" method="POST"
                                    action="{{ route('admin_reserve_space_destroy', $ReserveSpace->id) }}"> @csrf
                                    <input type="hidden" name="id" value="{{ $ReserveSpace->id }}">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">削除</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
