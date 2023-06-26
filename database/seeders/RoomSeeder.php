<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'room_type' => 'シングル',
            'number_of_rooms' => '3',
            'capacity' => '2',
            'content' => 'この部屋はシングルのお部屋です。',
        ]);

        Room::create([
            'room_type' => 'ダブル',
            'number_of_rooms' => '3',
            'capacity' => '3',
            'content' => 'この部屋はダブルのお部屋です。',
        ]);

        Room::create([
            'room_type' => 'デラックス',
            'number_of_rooms' => '2',
            'capacity' => '3',
            'content' => 'この部屋はデラックスのお部屋です。',
        ]);
    }
}
