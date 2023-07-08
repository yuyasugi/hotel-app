<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Plan\StoreRequest;
use App\Models\Plan;
use App\Models\ReserveSpace;
use App\Models\Room;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class PlanController extends BaseController
{
    public function admin_plan_create(){
        return view('admin.plan.create');
    }

    public function admin_plan_store(StoreRequest $request){
        Plan::create(['title' => $request->title, 'content' => $request->content, 'cheapest_price' => $request->cheapest_price, 'highest_price' => $request->highest_price, 'meal' => $request->meal]);

        return redirect()->route('admin_space_price_create')
            ->with('success', '宿泊プランを作成しました。');
    }

    public function admin_space_price_create(){

        $Plans = Plan::get();
        $Rooms = Room::get();

        return view('admin.plan.space_price_create', compact('Plans', 'Rooms'));
    }

    public function admin_space_price_store(Request $request){
        dd($request);


        return redirect()->route('admin_space_price_create')
            ->with('success', '宿泊プランを作成しました。');
    }
}
