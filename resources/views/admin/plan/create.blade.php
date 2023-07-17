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
                    <form class="admin_plan_create" method="POST" action="{{ route('admin_plan_store') }}" enctype="multipart/form-data">
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
                                <textarea rows="10" id="content" type="text" class="form-control @error('content') is-invalid @enderror" required autocomplete="content" name="content" value="{{ old('content') }}"></textarea>
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
                                <label id="upload_label" class="btn btn-success" for="images">画像を選択</label>
                                <input id="images" type="file" class="d-none" name="images[]" multiple>
                                @error('images.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="image_preview" class="row mt-3"></div> <!-- 画像プレビューを表示する場所 -->
                            </div>
                            {{-- <div class="mt-3">
                                <label for="meal_state">食事：</label><br>
                                <select id="meal_state" class="form-control @error('meal_state') is-invalid @enderror w-25" required autocomplete="meal_state" name="meal_state" value="{{ old('meal_state') }}">
                                    <option value="食事なし">食事なし</option>
                                    <option value="朝食あり">朝食あり</option>
                                    <option value="2食付き">2食付き</option>
                                </select>
                                @error('meal_state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                        </div>
                        <button class="btn btn-outline-success" type="submit">予約枠ごとの料金設定へ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector("#images").addEventListener("change", function(e){
            let imagePreview = document.querySelector("#image_preview");
            imagePreview.innerHTML = ""; // Clear the preview
            Array.from(e.target.files).forEach(file => {
                let reader = new FileReader();
                reader.onloadend = function() {
                    let img = document.createElement("img");
                    img.src = reader.result;
                    img.classList.add("img-thumbnail", "col-md-3"); // Add Bootstrap classes
                    imagePreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });
        </script>

</x-app-layout>
