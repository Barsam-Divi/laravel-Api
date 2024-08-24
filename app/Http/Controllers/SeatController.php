<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeatResource;
use App\Models\seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'seats' => SeatResource::collection(seat::all())
            ]
        ]);
    }
}
