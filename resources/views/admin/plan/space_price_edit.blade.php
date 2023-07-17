<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プランの料金の編集') }}
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
                    @foreach ($Plan as $Plan)
                        <form class="admin_space_price_update" method="POST"
                            action="{{ route('admin_space_price_update', $Plan->id) }}">
                            @csrf
                            <div class="form-group">
                                <div class="my-5">
                                    <label for="plan">プラン：</label><br>
                                    <p>{{ $Plan->title }}</p>
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
                                            @foreach ($SpacePrices as $index => $SpacePrice)
                                                @if (isset($SpacePrice->reserve_space->date))
                                                    <tr>
                                                        <td>
                                                            @php
                                                                // 日付をCarbonインスタンスに変換し、日本語設定を追加
                                                                \Carbon\Carbon::setLocale('ja');
                                                                $date = \Carbon\Carbon::parse($SpacePrice->reserve_space->date);
                                                                $dayOfWeek = $date->dayOfWeek;
                                                            @endphp

                                                            @if ($dayOfWeek == \Carbon\Carbon::SATURDAY)
                                                            <span class="text-primary">{{ $date->isoFormat('Y年M月D日（ddd）') }}</span>
                                                            @elseif ($dayOfWeek == \Carbon\Carbon::SUNDAY)
                                                            <span class="text-danger">{{ $date->isoFormat('Y年M月D日（ddd）') }}</span>
                                                            @else
                                                            {{ $date->isoFormat('Y年M月D日（ddd）') }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $SpacePrice->reserve_space->room->room_type }}</td>
                                                        <td>{{ $SpacePrice->reserve_space->count }}</td>
                                                        <td>
                                                            <div class="">
                                                                <input class="form-control" type="text"
                                                                    name="price[]" value="{{ $SpacePrice->price }}">
                                                                <input class="form-control" type="hidden"
                                                                    name="space_price_id[]"
                                                                    value="{{ $SpacePrice->id }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-outline-success mt-2" type="submit">編集する</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
