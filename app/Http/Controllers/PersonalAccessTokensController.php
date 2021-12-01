<?php

namespace App\Http\Controllers;

/* Routes examples
Route::get('personal_access_tokens/search', 'App\Http\Controllers\PersonalAccessTokensController@search');
Route::get('personal_access_tokens/find/{id}','App\Http\Controllers\PersonalAccessTokensController@find');
Route::post('personal_access_tokens/save', 'App\Http\Controllers\PersonalAccessTokensController@save');
Route::post('personal_access_tokens/valid', 'App\Http\Controllers\PersonalAccessTokensController@valid');
Route::post('personal_access_tokens/remove', 'App\Http\Controllers\PersonalAccessTokensController@remove');
Route::get('personal_access_tokens/clone/{id}','App\Http\Controllers\PersonalAccessTokensController@clone');
Route::get('personal_access_tokens/export', 'App\Http\Controllers\PersonalAccessTokensController@export');
*/

class PersonalAccessTokensController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}

	public function search() {
		return \App\Models\PersonalAccessTokens::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\PersonalAccessTokens::find($id);
	}

	public function save() {
		return (new \App\Models\PersonalAccessTokens)->store(request()->all());
	}

	public function valid() {
		return \App\Models\PersonalAccessTokens::new()->validate(request()->all());
	}

	public function remove($id) {
		return \App\Models\PersonalAccessTokens::search()->remove();
	}

	public function clone($id) {
		return \App\Models\PersonalAccessTokens::find($id)->clone();
	}

	public function export() {
		return \App\Models\PersonalAccessTokens::search()->export(export('format', 'csv'));
	}
}