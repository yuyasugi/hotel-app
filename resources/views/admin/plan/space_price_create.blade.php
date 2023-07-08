<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約枠ごとの料金設定') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <p class="text-danger">入力に問題があります。再入力してください。</p>
                    @endif
                    <form class="admin_plan_create" method="POST" action="{{ route('admin_space_price_store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="mt-3">
                                <label for="plan">プランを選択：</label><br>
                                <select id="plan" class="form-control @error('plan') is-invalid @enderror w-25"
                                    required autocomplete="plan" name="plan" value="{{ old('plan') }}">
                                    @foreach ($Plans as $Plan)
                                        <option value="{{ $Plan->id }}">{{ $Plan->title }}</option>
                                    @endforeach
                                </select>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="mt-3">
                                    <label for="room">部屋を選択：</label><br>
                                    <select id="room" class="form-control @error('room') is-invalid @enderror w-25"
                                        required autocomplete="room" name="room" value="{{ old('room') }}">
                                        @foreach ($Rooms as $Room)
                                            <option value="{{ $Room->id }}">{{ $Room->room_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label>期間</label>
                                    <input id="first_date"
                                        class="form-control w-25 @error('first_date') is-invalid @enderror" required
                                        autocomplete="first_date" type="date" name="first_date"
                                        value="{{ old('first_date') }}">〜
                                    @error('first_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <input id="last_date"
                                        class="form-control mb-3 w-25 @error('last_date') is-invalid @enderror" required
                                        autocomplete="last_date" type="date" name="last_date"
                                        value="{{ old('last_date') }}">
                                    @error('last_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="price">料金</label>
                                    <input id="price" type="text"
                                        class="form-control @error('price') is-invalid @enderror w-25" required
                                        autocomplete="price" name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-outline-success mt-2" type="submit">設定する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
