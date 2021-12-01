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

	public function search() {
		return \App\Models\LoteriaMegasena::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\LoteriaMegasena::find($id);
	}

	public function save() {
		return (new \App\Models\LoteriaMegasena)->store(request()->all());
	}

	public function valid() {
		return \App\Models\LoteriaMegasena::new()->validate(request()->all());
	}

	public function remove($id) {
		return \App\Models\LoteriaMegasena::search()->remove();
	}

	public function clone($id) {
		return \App\Models\LoteriaMegasena::find($id)->clone();
	}

	public function export() {
		return \App\Models\LoteriaMegasena::search()->export(export('format', 'csv'));
	}
}