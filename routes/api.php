<?php

use App\Http\Controllers\PackController;
use App\Http\Controllers\WolfController;
use App\Models\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('wolves', WolfController::class)->only([
    "index", "store", "show", "update", "destroy"
]);
Route::resource('packs', PackController::class);
Route::get('/packs/{id}/wolves', [PackController::class, 'getWolvesByPackId']);
