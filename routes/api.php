<?php

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

//oauth desteği için laravel passport kullanacaktım ama sanctum ile ortak implementasyonları oldugu için teknik olarak
//imkansız oldugunu fark ettim. inertia kullandığım için böyle bir problem yaşadım. kısıtlı sürem oldugu için uygulamayı
//baştan yazmak istemedim bu yüzden insiyatif kullanıp laravel sanctum ile authorization işlemlerini yaptım.
Route::prefix('/v1')->group(function () {

    Route::post('auth/login/', [App\Http\Controllers\API\AuthApiController::class, 'login']);
    Route::post('auth/register/', [App\Http\Controllers\API\AuthApiController::class, 'register']);
    Route::get('auth/logout/', [App\Http\Controllers\API\AuthApiController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('posts', App\Http\Controllers\API\PostApiController::class);
        Route::POST('post/publish/{post}', [App\Http\Controllers\API\PostApiController::class, 'publish'])->middleware('auth:sanctum');
        Route::POST('post/unpublish/{post}', [App\Http\Controllers\API\PostApiController::class, 'unpublish'])->middleware('auth:sanctum');
    });
});
