<?php

namespace App\Http\Controllers\Guest;

use App\Models\Plan;
use App\Models\SpacePrice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserPlanController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $plans = Plan::select()
                ->whereNull('deleted_at')
                ->get();
        return view('guest.plan.index',compact('plans'));
    }

    public function show($id){
        $plans = Plan::select()
                ->where('id', '=', $id)
                ->get();

        $space_prices = SpacePrice::where('plan_id', '=', $id)->get();

        $unique_rooms = $space_prices->unique(function ($item) {
            return $item->reserve_space->room->room_type;
        })->values();

        return view('guest.plan.show',compact('plans','space_prices','unique_rooms'));
    }
}
