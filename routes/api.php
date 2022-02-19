<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RealEstateController;
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

Route::get('/realestate', [RealEstateController::class, 'index']);
Route::post('/realestate', [RealEstateController::class, 'create']);
Route::get('/realestate/{id}', [RealEstateController::class, 'show']);
Route::put('/realestate/{id}', [RealEstateController::class, 'update']);
Route::delete('/realestate/{id}', [RealEstateController::class, 'delete']);

//Route::get('books', 'Api\BookController@getAllBooks');
//Route::get('realestate/show/{id}', 'Api\BookController@getBook');
//Route::post('realestate/create', 'API\RealEstateController@createRealEstate');
//Route::put('books/{id}', 'Api\BookController@updateBook');
//Route::delete('books/{id}','Api\BookController@deleteBook');