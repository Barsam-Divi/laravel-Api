<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HallSeatController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAccessMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response([
        'data'=>\request()->all()
    ],200);
});


Route::middleware('auth:sanctum')->group(function (){


    Route::delete('/logout' , [UserController::class , 'logout']);


    Route::prefix('/categories')->group(function (){

        Route::post('/',[CategoryController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-category');

        Route::patch('/{category}' , [CategoryController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':update-category');


        Route::delete('/{category}',[CategoryController::class , 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-category');
    });

    Route::prefix('/users')->group(function (){
        Route::get('/',[UserController::class , 'index'])
            ->middleware(TokenAccessMiddleware::class.':read-user');

        Route::get('/{user}',[UserController::class , 'show'])
            ->middleware(TokenAccessMiddleware::class.':read-user');
    });

    Route::prefix('/artists')->group(function (){
        Route::post('/',[ArtistController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-artist');

        Route::patch('/{artist}',[ArtistController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':update-artist');

        Route::delete('/{artist}' , [ArtistController::class, 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-artist');
    });

    Route::prefix('/roles')->group(function (){

        Route::get('/',[RoleController::class , 'index'])
            ->middleware(TokenAccessMiddleware::class.':read-role');

        Route::get('/{role}',[RoleController::class , 'show'])
            ->middleware(TokenAccessMiddleware::class.':read-role');

        Route::post('/',[RoleController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-role');

        Route::patch('/{role}',[RoleController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':update-role');

        Route::delete('/{role}' , [RoleController::class, 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-role');
    });

    Route::prefix('/concerts')->group(function (){

        Route::post('/',[ConcertController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-concert');

        Route::patch('/{concert}',[ConcertController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':update-concert');

        Route::delete('/{concert}' , [ConcertController::class, 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-concert');

    });

    Route::prefix('/halls')->group(function (){

        Route::get('/',[HallController::class , 'index'])
            ->middleware(TokenAccessMiddleware::class.':read-hall');

        Route::post('/',[HallController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-hall');

        Route::patch('/{hall}',[HallController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':update-hall');

        Route::delete('/{hall}' , [HallController::class, 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-hall');
        /*
         * Hall-seats route
         * */
        Route::post('/{hall}/seats',[HallSeatController::class , 'store'])
            ->middleware(TokenAccessMiddleware::class.':create-halls-seats');

        Route::patch('/{hall}/seats',[HallSeatController::class , 'update'])
            ->middleware(TokenAccessMiddleware::class.':create-halls-seats');

        Route::delete('/{hall}/seats',[HallSeatController::class , 'destroy'])
            ->middleware(TokenAccessMiddleware::class.':delete-halls-seats');


    });

    Route::middleware(TokenAccessMiddleware::class.':read-permission')
        ->get('/permissions',[PermissionController::class , 'index']);



});

Route::post('/register',[UserController::class , 'register']);

Route::post('/login',[UserController::class , 'login'])->name('login');


Route::get('/artists',[ArtistController::class, 'index']);

Route::get('/artists/{artist}',[ArtistController::class , 'show']);


Route::get('/categories',[CategoryController::class , 'index']);


Route::get('/categories/{category}',[CategoryController::class , 'show']);

Route::get('/concerts',[ConcertController::class , 'index']);

Route::get('/concerts/{concert}',[ConcertController::class , 'show']);

Route::get('/halls/{hall}',[HallController::class , 'show']);

Route::get('/seats',[SeatController::class , 'index']);





