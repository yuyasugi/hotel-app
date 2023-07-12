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
                            {{-- 画像登録機能を作成する --}}
                            <div class="mt-3">
                                <label for="images">画像：</label><br>
                                <input id="images" type="file" class="form-control @error('images.*') is-invalid @enderror" name="images[]" multiple>
                                @error('images.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="image_preview"></div> <!-- 画像プレビューを表示する場所 -->
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

    <script>
        window.addEventListener('load', function() {
            document.querySelector('#images').addEventListener('change', function(e) {
                var imagePreview = document.querySelector('#image_preview');
                imagePreview.innerHTML = '';

                Array.from(e.target.files).forEach(file => {
                    var img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = "preview-image";
                    img.onload = function() {
                        URL.revokeObjectURL(this.src);
                    }
                    imagePreview.appendChild(img);
                });
            });
        });
        </script>

</x-app-layout>
