<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [JWTController::class, 'register'])->name('register');
Route::post('/login', [JWTController::class, 'login'])->name('login');

Route::group(['middleware' => 'api'], function() {
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);

    Route::group(['middleware' => 'is-admin'], function() {
        
        Route::post('/addItem',[ItemController::class, 'addItem']);
        Route::post('/updateItem/{id}',[ItemController::class, 'updateItem']);
        Route::post('/deleteItem/{id}',[ItemController::class, 'destroyItem']);
    });

    Route::get('/getAllItems/{id?}',[ItemController::class, 'getAllItems']);
    Route::get('/getFavorites',[UserController::class, 'getFavorites']);
    
    Route::get('/getAllCategories/{id?}',[CategoryController::class, 'getAllCategories']);
    Route::post('/addCategory',[CategoryController::class, 'addCategory']);
    Route::post('/updateCategory/{id}',[CategoryController::class, 'updateCategory']);
    Route::post('/deleteCategory/{id}',[CategoryController::class, 'destroyCategory']);

    
});
    Route::get('get-items/{category}',[CategoryController::class, 'getItems']);