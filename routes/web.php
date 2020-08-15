<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('aktoriai')->group(function() {
//     Route::get('/', 'ActorController@index');
//     Route::post('/{actorId}/delete', 'ActorController@destroy');
//     Route::post('/{actorId}/update', 'ActorController@update');
// });
Route::resource('aktoriai','ActorController');
Route::post('aktoriai/{aktoriai}/time/update', 'ActorController@timeUpdate')->name('aktoriai.timeupdate');

Route::prefix('projektai')->group(function() {
    Route::get('/', 'ProjectController@index');

});
