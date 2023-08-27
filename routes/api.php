<?php

use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\PurchasedItemsController;
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

// http://127.0.0.1:8000/api/purchased-items GET  Method {to get all items}
// http://127.0.0.1:8000/api/purchased-items/1 GET  Method {to get specific id item}
// http://127.0.0.1:8000/api/purchased-items/ POST  Method {to store an item}
// http://127.0.0.1:8000/api/purchased-items/1 PUT  Method {to update an item}
// http://127.0.0.1:8000/api/purchased-items/1 DELETE  Method {to delete an item}
//   same for the purchases
Route::resource('purchases', 'App\Http\Controllers\PurchasesController');
Route::resource('purchased-items', 'App\Http\Controllers\PurchasedItemsController');



Route::get('/customers', [CustomerApiController::class, 'index']);
Route::post('/customers', [CustomerApiController::class, 'create']);
Route::get('/customers/{customerId}', [CustomerApiController::class, 'read']);
Route::put('/customers/{customerId}', [CustomerApiController::class, 'update']);
Route::delete('/customers/{customerId}', [CustomerApiController::class, 'delete']);


Route::get('/products', [ProductApiController::class, 'index']);
Route::post('/products', [ProductApiController::class, 'create']);
Route::get('/products/{productId}', [ProductApiController::class, 'read']);
Route::put('/products/{productId}', [ProductApiController::class, 'update']);
Route::delete('/products/{productId}', [ProductApiController::class, 'delete']);



