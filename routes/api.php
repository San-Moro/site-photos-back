<?php

use App\Http\Controllers\Api\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/test', function() {
//    return response()->json([
//        'success' => true,
//        'results' => [
//            'user' => 'Valentina',
//            'country' => 'Italy'
//        ]
//    ]);
//});

Route::get('/photos', [PhotoController::class, 'index']);
Route::get('/photos/{id}', [PhotoController::class, 'show']);
Route::get('/tags/{tagId}/photos', [PhotoController::class, 'getPhotosByTag']);