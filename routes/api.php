<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\TicketTransactionsController;
use App\Http\Controllers\UserEventController;
use App\Models\Event;
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

//public routes
Route::get('/events/explore', [EventController::class, 'index']);
Route::get('/events/explore/{event}', [EventController::class, 'show']);
Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth', [AuthController::class, 'index']);
Route::get('/tickets', [EventTicketController::class, 'index']);


//protected routes
Route::group(['middleware' => ['auth:sanctum']],function () {
    //events routes
    Route::post('/events/create', [EventController::class, 'store']);
    Route::patch('/events/manage/{event}', [EventController::class, 'update']);
    Route::delete('/events/delete/{id}', [EventController::class, 'destroy']);
    //tickets routes
    Route::post('/tickets/create/{event_id?}', [EventTicketController::class, 'store']);
    Route::get('/tickets/info/{id}', [EventTicketController::class, 'show']);
    Route::patch('/tickets/manage/{id}', [EventTicketController::class, 'update']);
    Route::delete('/tickets/delete/{id}', [EventTicketController::class, 'destroy']);
    //users routes
    Route::patch('/users/update/{id}', [AuthController::class, 'update']);
    Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
    Route::get('/users/events/{user}', [AuthController::class, 'show']);
    Route::get('/users/billing/{user}', [AuthController::class, 'getBilling']);
    Route::post('/users/billing/add', [AuthController::class, 'billing']);
    //transaction routes
    Route::post('/tickets/checkout/{ticket_id?}', [TicketTransactionsController::class, 'store']);
    Route::get('/tickets/transactions', [TicketTransactionsController::class, 'index']);
   
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
