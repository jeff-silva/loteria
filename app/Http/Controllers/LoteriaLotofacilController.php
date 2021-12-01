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

	public function search() {
		return \App\Models\LoteriaLotofacil::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\LoteriaLotofacil::find($id);
	}

	public function save() {
		return (new \App\Models\LoteriaLotofacil)->store(request()->all());
	}

	public function valid() {
		return \App\Models\LoteriaLotofacil::new()->validate(request()->all());
	}

	public function remove($id) {
		return \App\Models\LoteriaLotofacil::search()->remove();
	}

	public function clone($id) {
		return \App\Models\LoteriaLotofacil::find($id)->clone();
	}

	public function export() {
		return \App\Models\LoteriaLotofacil::search()->export(export('format', 'csv'));
	}
}