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
                    <form class="create_inquiry" method="POST" action="{{ route('contact_confirm') }}">
                        @csrf
                        <div class="form-group">
                            <div class="mt-3">
                                <label for="name" class="required-tag">名前<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <p class="required">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="email" class="required-tag mt-3">メールアドレス<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <p class="required">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="phone_number" class="required-tag mt-3">電話番号<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                @if($errors->has('phone_number'))
                                    <p class="required">{{ $errors->first('phone_number') }}</p>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="content" class="required-tag mt-3">お問い合せ内容<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label><br>
                                <textarea class="form-control mb-3" type="text" name="content" id="content" value="{{ old('content') }}" rows="5"></textarea>
                                @if($errors->has('content'))
                                    <p class="required">{{ $errors->first('content') }}</p>
                                @endif
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
