<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('宿泊プラン編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($errors) > 0)
                    <p class="text-danger">入力に問題があります。再入力してください。</p>
                    @endif
                    @foreach ($Plans as $index => $Plan)
                    <form class="admin_plan_edit" method="POST"
                            action="{{ route('admin_plan_update', $Plan->id) }}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <div class="mt-3">
                                <label for="title">プラン名：</label><br>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" required autocomplete="title" name="title" value="{{ $Plan->title }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="content">内容：</label><br>
                                <textarea rows="10" id="content" type="text" class="form-control @error('content') is-invalid @enderror" required autocomplete="content" name="content" value="{{ old('content') }}">{{ $Plan->content }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="cheapest_price">最安値：</label>
                                <input id="cheapest_price" type="text" class="form-control @error('cheapest_price') is-invalid @enderror w-25" required autocomplete="cheapest_price" name="cheapest_price" value="{{ $Plan->cheapest_price }}">
                                @error('cheapest_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- 画像編集機能を作成する --}}
                            <div class="mt-3">
                                <!-- 登録されている画像の表示と削除 -->
                                <div>
                                    @foreach ($Plan->images as $image)
                                    <div class="d-inline-block">
                                        <img src="{{ asset('images/' . $image->filename) }}" alt="Plan Image" width="200" class="mr-3 mb-3">
                                        <button type="button" class="btn btn-outline-danger delete-image" data-id="{{ $image->id }}">削除</button>
                                    </div>
                                    @endforeach
                                    <div id="image_preview" class="row mt-3"></div> <!-- 画像プレビューを表示する場所 -->
                                </div>
                                <div>
                                    <label id="upload_label" class="btn btn-outline-success" for="images">画像を追加</label>
                                    <input id="images" type="file" class="d-none" name="images[]" multiple>
                                    @error('images.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="preview" class="d-flex flex-wrap"></div>
                                </div>
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
                        <button class="btn btn-outline-success" type="submit">料金の編集へ</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.delete-image').on('click', function() {
        let id = $(this).data('id');

        $.ajax({
            url: '/images/' + id,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function() {
                alert('本当に削除してもいいですか？');
                location.reload();
            }
        });
    });
});

document.getElementById("images").addEventListener("change", function(e) {
        // Clear out the preview div
        document.getElementById("preview").innerHTML = "";

        // For each selected file
        for(let i = 0; i < e.target.files.length; i++) {
            // Create a new FileReader
            let reader = new FileReader();

            // When the image is loaded
            reader.onload = function(e) {
                // Create a new image element
                let img = document.createElement("img");
                img.src = e.target.result;

                img.classList.add('img-thumbnail'); // Add Bootstrap class for styling
                img.style.maxWidth = '100px'; // Set max-width

                // Add the image to the preview div
                document.getElementById("preview").appendChild(img);
            }

            // Read in the image file
            reader.readAsDataURL(e.target.files[i]);
        }
    });
</script>

</x-app-layout>
