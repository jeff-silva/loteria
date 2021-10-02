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

\Inertia\Inertia::share('tiposAposta', (new \App\Models\Loteria)->tiposAposta());

Route::get('/', '\App\Http\Controllers\AppController@index');

Route::get('/loteria', '\App\Http\Controllers\LoteriaController@index');
Route::get('/loteria/{type}', '\App\Http\Controllers\LoteriaController@loteriaView');