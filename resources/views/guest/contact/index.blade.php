<x-guests-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('お問い合わせ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($errors) > 0)
                    <p class="text-danger">入力に問題があります。再入力してください。</p>
                    @endif
                    <form class="create_inquiry" method="POST" action="{{ route('contact_confirm') }}">
                        @csrf
                        <div class="form-group">
                            <div class="mt-3">
                                <label for="name" class="required-tag">お名前<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" required autocomplete="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="email" class="required-tag mt-3">メールアドレス<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="phone_number" class="required-tag mt-3">電話番号（ハイフンあり）<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" required autocomplete="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="content" class="required-tag mt-3">お問い合せ内容<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror mb-3" type="text" name="content" value="{{ old('content') }}" rows="5"></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                        <button class="btn btn-outline-success mt-3" type="submit">入力内容確認</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guests-layout>
