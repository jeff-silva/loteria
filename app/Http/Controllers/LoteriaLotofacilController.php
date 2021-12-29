<?php

namespace App\Http\Controllers;

/* Routes examples
Route::get('loteria_lotofacil/search', 'App\Http\Controllers\LoteriaLotofacilController@search');
Route::get('loteria_lotofacil/find/{id}','App\Http\Controllers\LoteriaLotofacilController@find');
Route::post('loteria_lotofacil/save', 'App\Http\Controllers\LoteriaLotofacilController@save');
Route::post('loteria_lotofacil/valid', 'App\Http\Controllers\LoteriaLotofacilController@valid');
Route::post('loteria_lotofacil/remove', 'App\Http\Controllers\LoteriaLotofacilController@remove');
Route::get('loteria_lotofacil/clone/{id}','App\Http\Controllers\LoteriaLotofacilController@clone');
Route::get('loteria_lotofacil/export', 'App\Http\Controllers\LoteriaLotofacilController@export');
*/

class LoteriaLotofacilController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}