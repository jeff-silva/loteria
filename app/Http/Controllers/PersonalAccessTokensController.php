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
	
}