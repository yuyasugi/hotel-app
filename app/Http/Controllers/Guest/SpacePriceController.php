<?php

namespace App\Http\Controllers\Guest;

use App\Models\Plan;
use App\Models\SpacePrice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SpacePriceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSpacePrices(Request $request)
    {
        $roomId = $request->get('room_id');
        $planId = $request->get('plan_id');

        $spacePrices = SpacePrice::with('reserve_space')
            ->whereHas('reserve_space', function($query) use ($roomId, $planId) {
                $query->where('room_id', $roomId)
                    ->where('plan_id', $planId);
            })
            ->get();

        $calendarData = [];

        foreach ($spacePrices as $spacePrice) {
            $reserveCount = $spacePrice->reserve_space->count;
            $symbol = '×';
            if ($reserveCount > 2) {
                $symbol = '⚪';
            } elseif ($reserveCount > 0) {
                $symbol = '△';
            }

            $calendarData[] = [
                'title' => $spacePrice->price . '円 ' . $symbol,
                'start' => $spacePrice->reserve_space->date,
                'end' => $spacePrice->reserve_space->date,
            ];
        }

        return response()->json($calendarData);
    }
}
