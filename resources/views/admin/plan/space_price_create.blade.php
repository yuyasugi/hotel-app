<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プランの料金設定') }}
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
                            <div class="my-5">
                                <label for="plan">プランを選択：</label><br>
                                <select id="plan" class="form-control @error('plan') is-invalid @enderror w-25"
                                    required autocomplete="plan" name="plan_id">
                                    @foreach ($Plans as $Plan)
                                        <option value="{{ $Plan->id }}" data-price="{{ $Plan->cheapest_price }}">
                                            {{ $Plan->title }}</option>
                                    @endforeach
                                </select>
                                @error('plan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">日付</th>
                                            <th scope="col">部屋タイプ</th>
                                            <th scope="col">部屋数</th>
                                            <th scope="col">料金</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ReserveSpaces as $index => $ReserveSpace)
                                            @php
                                                $planId = $ReserveSpace->plan_id;
                                                $defaultPrice = old('price.' . $index, $ReserveSpace->default_price);
                                                $cheapestPrice = $Plans[$planId]['cheapest_price'] ?? null;
                                                $spacePrice = $SpacePrices[$planId]['price'] ?? null;
                                                $price = $cheapestPrice === $spacePrice ? $defaultPrice : $spacePrice ?? $cheapestPrice;
                                            @endphp
                                            <tr>
                                                <td
                                                    class="{{ $ReserveSpace->dayOfWeek === 6 ? 'saturday' : ($ReserveSpace->dayOfWeek === 0 || $ReserveSpace->isHoliday ? 'sunday-holiday' : '') }}">
                                                    {{ $ReserveSpace->date }}（{{ ['日', '月', '火', '水', '木', '金', '土'][$ReserveSpace->dayOfWeek] }}）
                                                </td>
                                                <td>{{ $ReserveSpace->room->room_type }}</td>
                                                <td>{{ $ReserveSpace->count }}</td>
                                                <td>
                                                    <div class="">
                                                        <input class="form-control" type="text" name="price[]"
                                                            value="{{ $price }}">
                                                        <input class="form-control" type="hidden"
                                                            name="reserve_space_id[]" value="{{ $ReserveSpace->id }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <button class="btn btn-outline-success mt-2" type="submit">設定する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // プラン選択時に料金を表示する関数
        function displayPlanPrice() {
            const planSelect = document.getElementById('plan');
            const priceInputs = document.getElementsByName('price[]');
            const selectedPlanId = planSelect.value;
            const selectedPlan = planSelect.options[planSelect.selectedIndex];
            const defaultPrice = selectedPlan.dataset.price;

            // デフォルトの価格を設定する関数
            function setDefaultPrice(input, index) {
                const customDefaultPrice = '{{ $ReserveSpaces[$index]->custom_default_price }}';
                input.value = customDefaultPrice !== '' ? customDefaultPrice : defaultPrice;
            }

            // 各 input フィールドにデフォルトの価格を設定する
            priceInputs.forEach(function(input, index) {
                setDefaultPrice(input, index);
            });
        }

        // ページ読み込み時とプラン選択の変更時に関数を実行する
        window.addEventListener('DOMContentLoaded', displayPlanPrice);
        document.getElementById('plan').addEventListener('change', displayPlanPrice);
    </script>

    <style>
        .saturday {
            color: blue;
            /* 土曜日の文字色を青色に設定 */
        }

        .sunday-holiday {
            color: red;
            /* 日曜日と祝日の文字色を赤色に設定 */
        }
    </style>
</x-app-layout>
