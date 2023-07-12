<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Plan\StoreRequest;
use App\Models\Plan;
use App\Models\ReserveSpace;
use App\Models\Room;
use App\Models\SpacePrice;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlanController extends BaseController
{

    public function admin_plan_index(){
        $plans = Plan::all();
        return view('admin.plan.index',compact('plans'));
    }

    public function admin_plan_create(){
        return view('admin.plan.create');
    }

    public function admin_plan_store(Request $request){
        // dd($request);

        $plan = Plan::create([
            'title' => $request->title,
            'content' => $request->content,
            'cheapest_price' => $request->cheapest_price,
            'meal_state' => $request->meal
        ]);

        foreach ($request->images as $image) {
            $plan->images()->create(['filename' => $image]);
        }

        return redirect()->route('admin_space_price_create')
            ->with('success', '宿泊プランを作成しました。');
    }

    public function admin_space_price_create() {
        $Plans = Plan::get();

        // ReserveSpaceからデータを取得し、それぞれの要素に対して曜日情報を追加
        $ReserveSpaces = ReserveSpace::whereNull('deleted_at')->get()->each(function ($reserveSpace) {
            $date = Carbon::parse($reserveSpace->date);
            $reserveSpace->dayOfWeek = $date->dayOfWeek;
        });

        $spacePrices = SpacePrice::pluck('price', 'plan_id')->toArray();
        $cheapestPrices = Plan::pluck('cheapest_price', 'id')->toArray();

        return view('admin.plan.space_price_create', compact('Plans', 'ReserveSpaces', 'spacePrices', 'cheapestPrices'));
    }

    public function admin_space_price_store(Request $request){

        $planId = $request->input('plan_id');
        $prices = $request->input('price');
        $reserveSpaceIds = $request->input('reserve_space_id');

        $count = count($prices); // priceの要素数を取得

        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'plan_id' => $planId,
                'price' => $prices[$i],
                'reserve_space_id' => $reserveSpaceIds[$i]
            ];
        }

        SpacePrice::insert($data); // データを一括で保存


        return redirect()->route('admin_space_price_create')
            ->with('success', '宿泊プランを作成しました。');
    }
}
