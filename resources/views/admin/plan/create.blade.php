<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('宿泊プラン作成') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($errors) > 0)
                    <p class="text-danger">入力に問題があります。再入力してください。</p>
                    @endif
                    <form class="admin_plan_create" method="POST" action="{{ route('admin_plan_store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="mt-3">
                                <label for="title">プラン名：</label><br>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" required autocomplete="title" name="title" value="{{ old('title') }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="content">内容：</label><br>
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" required autocomplete="content" name="content" value="{{ old('content') }}"></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="cheapest_price">最安値：</label>
                                <input id="cheapest_price" type="text" class="form-control @error('cheapest_price') is-invalid @enderror w-25" required autocomplete="cheapest_price" name="cheapest_price" value="{{ old('cheapest_price') }}">
                                @error('cheapest_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="highest_price">最高値：</label>
                                <input id="highest_price" type="text" class="form-control @error('highest_price') is-invalid @enderror w-25" required autocomplete="highest_price" name="highest_price" value="{{ old('highest_price') }}">
                                @error('highest_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="meal">食事：</label><br>
                                <select id="meal" class="form-control @error('meal') is-invalid @enderror w-25" required autocomplete="meal" name="meal" value="{{ old('meal') }}">
                                    <option value="食事なし">食事なし</option>
                                    <option value="朝食あり">朝食あり</option>
                                    <option value="2食付き">2食付き</option>
                                </select>
                                @error('meal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-outline-success mt-2" type="submit">予約枠ごとの料金設定へ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
