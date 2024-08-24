<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewConcertRequest;
use App\Http\Requests\UpdateConcertRequest;
use App\Http\Resources\ConcertResource;
use App\Models\concert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        return response()->json([
            'data'  =>
            [
                'concerts' => ConcertResource::collection(concert::paginate(5))->response()
                ->getData()
            ]
        ])->setStatusCode(200);
    }

    public function store(NewConcertRequest $request)
    {



        $artistHavePlan = concert::query()
            ->where('artist_id' , $request->get('artist_id'))
            ->where(function (Builder $query) use ($request){
                $query->where('started_at','>=',$request->get('started_at'))
                    ->where('started_at','<=',$request->get('end_at'));
            })->orWhere(function (Builder $query) use ($request){
                $query->where('end_at','>=',$request->get('started_at'))
                    ->where('end_at','<=' ,$request->get('end_at'));
            })->exists();

        if ($artistHavePlan)
        {
            return response()->json([
                'data'=> [
                    'message' => 'this artist have a concert in Queue '
                ]
            ]);
        }

        $concert = concert::query()->create([
            'artist_id' => $request->get('artist_id'),
            'hall_id' => $request->get('hall_id'),
            'description' => $request->get('description'),
            'title' => $request->get('title'),
            'started_at' => $request->get('started_at'),
            'end_at' => $request->get('end_at'),
            'published' => $request->get('published',false)
        ]);


        return response()->json([
            'data' => [
                'concert' => new ConcertResource($concert)
            ]
        ])->setStatusCode(201);
    }

    public function update(concert $concert,UpdateConcertRequest $request)
    {

        if ($request->filled('artist_id') && $request->get('started_at') && $request->get('end_at'))
        {
            $artistHavePlan = concert::query()
                ->where('artist_id' , $request->get('artist_id'))
                ->where(function (Builder $query) use ($request){
                    $query->where('started_at','>=',$request->get('started_at'))
                        ->where('started_at','<=',$request->get('end_at'));
                })->orWhere(function (Builder $query) use ($request){
                    $query->where('end_at','>=',$request->get('started_at'))
                        ->where('end_at','<=' ,$request->get('end_at'));
                })->exists();

            if ($artistHavePlan)
            {
                return response()->json([
                    'data'=> [
                        'message' => 'this artist have a concert in Queue in this dates'
                    ]
                ]);
            }
        }


        $concert->update([
            'artist_id' => $request->get('artist_id',$concert->artist_id),
            'hall_id' => $request->get('hall_id', $concert->hall_id),
            'description' => $request->get('description',$concert->description),
            'title' => $request->get('title',$concert->title),
            'started_at' => $request->get('started_at',$concert->started_at),
            'end_at' => $request->get('end_at',$concert->end_at),
            'published' => $request->get('published',$concert->published)
        ]);


        return response()->json([
            'data' => [
                'concert' => new ConcertResource($concert)
            ]
        ])->setStatusCode(201);
    }

    public function destroy(concert $concert)
    {
        $concert->delete();


        return response()->json([
            'data' =>
            [
                'message' => $concert->title.' '.'success fully deleted'
            ]
        ]);
    }

    public function show(concert $concert)
    {
        return response()->json([
            'data' => [
                'concert' => new ConcertResource($concert)
            ]
        ])->setStatusCode(201);
    }
}
