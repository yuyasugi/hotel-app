<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReserveSpace;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ReserveSpaceController extends BaseController
{

    public function admin_reserve_space_index(){

        $ReserveSpaces = ReserveSpace::with('room')
                            ->select()
                            ->whereNull('deleted_at')
                            ->get();

        return view('admin.reserve_space.index',compact('ReserveSpaces'));
    }



    public function admin_reserve_space_update(Request $request){

        $ReserveSpace = ReserveSpace::where('id', '=', $request->id)->first();

        if($ReserveSpace->reserve_flag === 0){
            ReserveSpace::where('id', $request->id)->update(['reserve_flag' => 1]);
        } else {
            ReserveSpace::where('id', $request->id)->update(['reserve_flag' => 0]);
        }

        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約状況を変更しました。');
    }



    public function admin_reserve_space_destroy(Request $request){

        ReserveSpace::where('id', $request->id)->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約枠を削除しました。');
    }



    public function admin_reserve_space_create(){

        $Rooms = Room::get();

        return view('admin.reserve_space.create',compact('Rooms'));
    }



    public function admin_reserve_space_store(Request $request){

        // dd($request);
        $Rooms = Room::get();

        $first_date = Carbon::parse($request->first_date);
        $last_date = Carbon::parse($request->last_date);
        $dates = [];

        while ($first_date->lte($last_date)) {
            $dates[] = $first_date->toDateString();
            $first_date->addDay();
        }

        $existDates = ReserveSpace::whereIn('date', $dates)
            ->where('room_id', $request->room)
            ->pluck('date')
            ->toArray();

        // 重複する日付が存在する場合は処理を中断する
        if (!empty($existDates)) {
            return redirect()->route('admin_reserve_space_create')
                ->with('error', '既に作成済みの日付が含まれています。');
        }

        // 期間内の各日に予約枠を作成する
        foreach ($dates as $date) {
            if($request->room == 1){
                ReserveSpace::create([
                    ["room_id" => $request->room, "date" => $date],
                    ["room_id" => $request->room, "date" => $date],
                    ["room_id" => $request->room, "date" => $date]
                  ]);
            } elseif($request->room == 2){
                ReserveSpace::create([
                    ["room_id" => $request->room, "date" => $date],
                    ["room_id" => $request->room, "date" => $date],
                    ["room_id" => $request->room, "date" => $date]
                  ]);
            }
        }
        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約枠を作成しました。');
    }
}
