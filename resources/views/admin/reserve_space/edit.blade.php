<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約枠編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @foreach ($ReserveSpaces as $index => $ReserveSpace)
                        <form class="admin_reserve_edit" method="POST"
                            action="{{ route('admin_reserve_space_update', $ReserveSpace->id) }}">
                            @csrf
                            <div class="form-group">
                                <label>部屋タイプ</label>
                                <select id="room" class="form-control w-25" name="room">
                                    @foreach ($Rooms as $Room)
                                        <option value="{{ $Room->id }}">{{ $Room->room_type }}</option>
                                    @endforeach
                                </select>
                                @error('room')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="mt-4">日付</label>
                                <input id="date" class="form-control mb-3 w-25 @error('date') is-invalid @enderror"
                                    required autocomplete="date" type="date" name="date"
                                    value="{{ old('date') }}">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="mt-3">予約枠解放数</label>
                                <input id="count" type="number" max="10"
                                    class="form-control w-25 @error('count') is-invalid @enderror" name="count"
                                    value="{{ $ReserveSpace->count }}" required autocomplete="count" autofocus>
                                @error('count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-outline-success mt-2" type="submit">更新する</button>
                            <input type="hidden" name="id" value="{{ $ReserveSpace->id }}">
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
