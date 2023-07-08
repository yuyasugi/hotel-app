<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReserveSpace\StoreRequest;
use App\Http\Requests\ReserveSpace\UpdateRequest;
use App\Models\ReserveSpace;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReserveSpaceController extends BaseController
{

    public function admin_reserve_space_index(){

        $ReserveSpaces = ReserveSpace::with('room')
                            ->select()
                            ->whereNull('deleted_at')
                            ->get();

        return view('admin.reserve_space.index',compact('ReserveSpaces'));
    }


    public function admin_reserve_space_create(){

        $Rooms = Room::get();

        return view('admin.reserve_space.create',compact('Rooms'));
    }


    public function admin_reserve_space_store(StoreRequest $request){

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

        foreach ($dates as $date) {
                ReserveSpace::create(["room_id" => $request->room, "count" => $request->count, "date" => $date]);
        }

        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約枠を作成しました。');
    }


    public function admin_reserve_space_edit($id){

        $ReserveSpaces = ReserveSpace::where('id', '=', $id)->get();
        // dd($ReserveSpaces);
        $Rooms = Room::get();

        return view('admin.reserve_space.edit',compact('ReserveSpaces', 'Rooms'));
    }


    public function admin_reserve_space_update(UpdateRequest $request){

        ReserveSpace::where('id', $request->id)->update(["room_id" => $request->room, "count" => $request->count, "date" => $request->date]);

        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約枠を編集しました。');
    }



    public function admin_reserve_space_destroy(Request $request){

        ReserveSpace::where('id', $request->id)->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect()->route('admin_reserve_space_index')
            ->with('success', '予約枠を削除しました。');
    }
}
