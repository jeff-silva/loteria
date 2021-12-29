<?php

namespace App\Http\Controllers;

/* Routes examples
Route::get('migrations/search', 'App\Http\Controllers\MigrationsController@search');
Route::get('migrations/find/{id}','App\Http\Controllers\MigrationsController@find');
Route::post('migrations/save', 'App\Http\Controllers\MigrationsController@save');
Route::post('migrations/valid', 'App\Http\Controllers\MigrationsController@valid');
Route::post('migrations/remove', 'App\Http\Controllers\MigrationsController@remove');
Route::get('migrations/clone/{id}','App\Http\Controllers\MigrationsController@clone');
Route::get('migrations/export', 'App\Http\Controllers\MigrationsController@export');
*/

class MigrationsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}