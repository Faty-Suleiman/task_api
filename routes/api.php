<?php
use Illuminate\Support\Facades\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaginationController;
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

 Route::get('/get-pages', [PaginationController::class, 'index']);
Route::group(['prefix' => 'auth'], function () {
      Route::post('/login', [AuthController::class, 'login']);
      Route::post('/register', [AuthController::class, 'register']);
     Route::post('/create-task', [TaskController::class, 'store']);
    Route::get('/get-single-task/{id}', [TaskController::class, 'show']);
    Route::delete('/delete-task/{id}',[TaskController::class,'destroy']);
    Route::put('/update-task/{id}',[TaskController::class,'update']);
    Route::get('/edit-task/{id}',[TaskController::class,'edit']);
    Route::get('/get-all-task',[TaskController::class, 'index']);
 });