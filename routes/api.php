<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\_TaskController;
use App\Http\Controllers\AuthController;
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
Route::get('/get-task', [_TaskController::class, 'index']);
Route::post('/create-task', [TaskController::class, 'store']);
Route::get('get-single-task/{id}', [TaskController::class, 'show']);
Route::get('edit-task/{id}/edit',[TaskController::class,'edit']);
Route::put('update-task/{id}/edit',[TaskController::class,'update']);
Route::delete('delete-task/{id}/delete',[TaskController::class,'delete']);
Route::group(['prefix' => 'auth'], function () {
      Route::post('login', [AuthController::class, 'login']);
      Route::post('register', [AuthController::class, 'register']);

});