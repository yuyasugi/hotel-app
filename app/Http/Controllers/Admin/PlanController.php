<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Plan\StoreRequest;
use App\Models\Plan;
use App\Models\PlanImage;
use App\Models\ReserveSpace;
use App\Models\SpacePrice;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlanController extends BaseController
{

    public function admin_plan_index(){
        $plans = Plan::select()
        ->whereNull('deleted_at')
        ->get();
        return view('admin.plan.index',compact('plans'));
    }

    public function admin_plan_create(){
        return view('admin.plan.create');
    }

    public function admin_plan_store(StoreRequest $request){
        $plan = Plan::create([
            'title' => $request->title,
            'content' => $request->content,
            'cheapest_price' => $request->cheapest_price
        ]);

        if ($request->hasfile('images')) {
            foreach($request->file('images') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/images/', $name);
                $planImage = new PlanImage(['filename' => $name]);
                $plan->images()->save($planImage);
            }
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
        return redirect()->route('admin_plan_index')
            ->with('success', '宿泊プランを作成しました。');
    }

    public function admin_plan_edit($id){
        $Plans = Plan::where('id', '=', $id)->get();

        return view('admin.plan.edit',compact('Plans'));
    }

    public function admin_plan_update(Request $request, $id){

        // fillableプロパティを設定したPlanモデルを使用
        $plan = Plan::findOrFail($id); // findOrFailを使用して、プランが存在しない場合は自動的にエラーページを表示

        // fillメソッドを使用して、一度に複数の属性を更新
        $plan->fill($request->only(['title', 'content', 'cheapest_price']));

        if ($request->hasfile('images')) {
            foreach($request->file('images') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/images/', $name);
                $planImage = new PlanImage(['filename' => $name]);
                $plan->images()->save($planImage);
            }
        }

        $plan->save();

        return redirect()->route('admin_space_price_edit', $id)
            ->with('success', 'プランを編集しました!');
    }

    public function admin_plan_destroy(Request $request){

        Plan::where('id', $request->id)->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect()->route('admin_plan_index')
            ->with('success', 'プランを削除しました。');
    }

    public function admin_space_price_edit($id) {
        $Plan = Plan::where('id', '=', $id)->get();
        // ReserveSpaceからデータを取得し、それぞれの要素に対して曜日情報を追加
        $SpacePrices = SpacePrice::where('plan_id', '=', $id)->whereNull('deleted_at')->get();
        // dd($SpacePrices);

        return view('admin.plan.space_price_edit', compact('Plan', 'SpacePrices'));
    }

    public function admin_space_price_update(Request $request, $id) {
        $prices = $request->input('price');
        $space_price_ids = $request->input('space_price_id');

        for ($i = 0; $i < count($space_price_ids); $i++) {
            $spacePrice = SpacePrice::find($space_price_ids[$i]);

            if ($spacePrice->price != $prices[$i]) {
                $spacePrice->price = $prices[$i];
                $spacePrice->save();
            }
        }
        return redirect()->route('admin_plan_index')
        ->with('success', '宿泊プランを編集しました。');
    }
}
