<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewHallRequest;
use App\Http\Requests\UpdateHallRequest;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'halls' => HallResource::collection(Hall::paginate(5))->response()->getData()
            ]
        ]);
    }

    public function show(Hall $hall)
    {
        return response()->json([
            'data' => [
                'hall' => new HallResource($hall)
            ]
        ]);
    }

    public function store(NewHallRequest $request)
    {
        $hall = Hall::query()->create([
            'name' => $request->get('name'),
            'seat_count' => $request->get('seat_count')
        ]);

        return response()->json([
            'data' => [
                'hall' => new HallResource($hall)
            ]
        ])->setStatusCode(201);
    }

    public function update(Hall $hall ,UpdateHallRequest $request)
    {

        $hallNameExists = Hall::query()->where('name' , $request->get('name'))
            ->where('id' , '!=' , $hall->id)
        ->exists();


        if ($hallNameExists)
        {
            return response()->json([
                'data' =>[
                    'message' => 'this '.$request->name.' is already exists chose another name'
                ]
            ]);
        }

        $hall->update([
            'name' => $request->get('name',$hall->name),
            'seat_count' => $request->get('seat_count',$hall->seat_count)
        ]);

        return response()->json([
            'data' => [
                'hall' => new HallResource($hall)
            ]
        ]);

    }

    public function destroy(Hall $hall)
    {
        $hall->delete();


        return response([
            'data' => [
                'message' => $hall->name.' '.'success fully deleted'
            ]
        ]);
    }
}
