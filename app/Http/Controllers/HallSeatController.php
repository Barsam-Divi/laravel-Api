<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewHallSeatRequest;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallSeatController extends Controller
{
    public function store(Hall $hall , NewHallSeatRequest $request)
    {

        $seat = $request->get('seats');


        $hallMaxSeat = collect($seat)->sum('seat_count');

        if ($hallMaxSeat > $hall->seat_count)
        {
            return  response()->json([
                'data' => [
                    'message' => ['the number of seat is to much for this hall this hall have
                    only'.$hall->seat_count]
                ]
            ])->setStatusCode(400);
        }

        $hall->seats()->attach($seat);


        return response()->json([
            'data' => [
                'HallSeats' => new HallResource($hall)
            ]
        ]);
    }

    public function update(Hall $hall , NewHallSeatRequest $request)
    {
        $seat = $request->get('seats');

        $hallMaxSeat = collect($seat)->sum('seat_count');

        if ($hallMaxSeat > $hall->seat_count)
        {
            return  response()->json([
                'data' => [
                    'message' => ['the number of seat is to much for this hall this hall have
                    only'.$hall->seat_count]
                ]
            ])->setStatusCode(400);
        }

        $hall->seats()->sync($seat);

        return response()->json([
            'data' => [
                'HallSeats' => new HallResource($hall)
            ]
        ]);
    }

    public function destroy(Hall $hall)
    {


        $hall->seats()->detach();


        return  response()->json([
            'data' => [
                'message' => ['halls seat success fully deleted']
            ]
        ])->setStatusCode(200);
    }
}
