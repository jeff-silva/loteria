<?php

namespace App\Http\Controllers;

/* Routes examples
Route::get('loteria_megasena/search', 'App\Http\Controllers\LoteriaMegasenaController@search');
Route::get('loteria_megasena/find/{id}','App\Http\Controllers\LoteriaMegasenaController@find');
Route::post('loteria_megasena/save', 'App\Http\Controllers\LoteriaMegasenaController@save');
Route::post('loteria_megasena/valid', 'App\Http\Controllers\LoteriaMegasenaController@valid');
Route::post('loteria_megasena/remove', 'App\Http\Controllers\LoteriaMegasenaController@remove');
Route::get('loteria_megasena/clone/{id}','App\Http\Controllers\LoteriaMegasenaController@clone');
Route::get('loteria_megasena/export', 'App\Http\Controllers\LoteriaMegasenaController@export');
*/

class LoteriaMegasenaController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}