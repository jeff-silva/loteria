<?php

namespace App\Http\Controllers;

/* Routes examples
Route::get('loteria_sorteios/search', 'App\Http\Controllers\LoteriaSorteiosController@search');
Route::get('loteria_sorteios/find/{id}','App\Http\Controllers\LoteriaSorteiosController@find');
Route::post('loteria_sorteios/save', 'App\Http\Controllers\LoteriaSorteiosController@save');
Route::post('loteria_sorteios/valid', 'App\Http\Controllers\LoteriaSorteiosController@valid');
Route::post('loteria_sorteios/remove', 'App\Http\Controllers\LoteriaSorteiosController@remove');
Route::get('loteria_sorteios/clone/{id}','App\Http\Controllers\LoteriaSorteiosController@clone');
Route::get('loteria_sorteios/export', 'App\Http\Controllers\LoteriaSorteiosController@export');
*/

class LoteriaSorteiosController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => ['type'],
		]);
	}

	static function router() {
		\Route::get('loteria-sorteios/types', 'App\Http\Controllers\LoteriaSorteiosController@types');
		\Route::get('loteria-sorteios/type/{type}', 'App\Http\Controllers\LoteriaSorteiosController@type');
		\Route::get('loteria-sorteios/sync', 'App\Http\Controllers\LoteriaSorteiosController@sync');
	}

	public function types() {
		return \App\Models\LoteriaSorteios::sorteioTypes();
	}

	public function type($type) {
		$item['type'] = \App\Models\LoteriaSorteios::sorteioType($type);
		$item['numbers'] = \App\Models\LoteriaSorteios::where(['type' => $type])->orderBy('id', 'desc')->get();
		return $item;
	}

	public function sync() {
		$types = array_filter(explode(',', request('types')));
		return \App\Models\LoteriaSorteios::sorteioSync($types);
	}
	
}