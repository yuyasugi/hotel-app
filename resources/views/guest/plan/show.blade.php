<x-guests-layout>
    <x-slot name="header">
        <div class="d-flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('宿泊プラン詳細') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($plans as $Plan)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="card-header bg-success d-flex align-items-center">
                        {{ $Plan->title }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="ml-5 mt-3">
                            {{-- ここで画像を表示 --}}
                            <div class="d-flex flex-wrap">
                                @foreach ($Plan->images as $image)
                                    <img src="{{ asset('images/' . $image->filename) }}" alt="Plan Image" width="300" class="mr-3 mb-3">
                                @endforeach
                            </div>
                            <label for="content">【プラン紹介】</label>
                            <p>{{ $Plan->content }}</p>
                            <label for="price">【ご料金】</label>
                            <p>{{ $Plan->cheapest_price }}円〜</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">空室</div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="room">部屋選択:</label>
                                <select id="room" class="form-control" onChange="updateCalendar()">
                                    @foreach($unique_rooms as $unique_room)
                                        <option value="{{ $unique_room->reserve_space->room->id }}">{{ $unique_room->reserve_space->room->room_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script src="calendar/google-calendar/index.global.js"></script>
    <script>
    var calendar;  // グローバルスコープでcalendarを定義

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ja'
        });
        calendar.render();
    });

    // 部屋が選択されるたびにカレンダーを更新
    function updateCalendar() {
        var roomId = document.getElementById('room').value;
        var planId = {{ $Plan->id }};  // ここでplanIdの値を取得する必要があります

        fetch('/get-space-prices?room_id=' + roomId + '&plan_id=' + planId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                calendar.removeAllEvents();  // 既存の全てのイベントを削除
                data.forEach(event => {
                    calendar.addEvent(event);  // 新しいイベントを追加
                });
            });
    }

    // ページロード時に初期化
    updateCalendar();
    </script>
</x-guests-layout>
