<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Resources\ArtistResources;
use App\Models\Artist;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistController extends Controller
{


    public function index()
    {

        return response([
            'data' => [
                'artists' => ArtistResources::collection(Artist::paginate(5))->response()
                ->getData()
            ]
        ]);
    }

    public function store(NewArtistRequest $request)
    {



      $avatarPath =  $this->
      FileUpload($request,'artists','avatar','avatar');

      $background = $this->
      FileUpload($request ,'artists','background','background');

      $artist =  Artist::query()->create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'avatar' => $avatarPath,
            'background' => $background
        ]);



        return response()->json([
            'data' => [
                'artist' => new ArtistResources($artist)
            ]
        ])->setStatusCode(201);
    }

    public function update(Artist $artist,UpdateArtistRequest $request)
    {



        $avatarPath = $artist->avatar;

        $background = $artist->background;

        if ($request->hasFile('avatar'))
        {
            Storage::delete($artist->avatar);
            $avatarPath =  $this->
            FileUpload($request,'artists','avatar','avatar');
        }

        if ($request->hasFile('background'))
        {

            Storage::delete($artist->background);

            $background = $this->
            FileUpload($request ,'artists','background','background');
        }

        $artist->update([
            'name' => $request->get('name',$artist->name),
            'category_id' => $request->get('category_id' , $artist->category_id),
            'avatar' => $avatarPath,
            'background' => $background,
        ]);

        return response()->json([
            'data' => [
                'artist' => new ArtistResources($artist)
            ]
        ])->setStatusCode(201);
    }

    public function show(Artist $artist)
    {
        return response()->json([
            'data' => [
                'artist' => new ArtistResources($artist)
            ]
        ])->setStatusCode(201);
    }

    public function destroy(Artist $artist)
    {

        Storage::delete($artist->avatar);

        Storage::delete($artist->background);

        $artist->delete();


        return response([
            'data' =>[
                'message' => $artist->name.' '.'successfully Deleted'
            ]
        ]);
    }
}
