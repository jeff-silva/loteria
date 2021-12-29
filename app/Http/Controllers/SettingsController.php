<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}

	static function router() {
		\Route::post('settings/save-all', 'App\Http\Controllers\SettingsController@saveAll');
		\Route::get('settings/get-all', 'App\Http\Controllers\SettingsController@getAll');
	}

	public function getAll() {
		return (new \App\Models\Settings)->getAll();
	}

	public function saveAll() {
		return (new \App\Models\Settings)->saveAll(request()->all());
	}
	
}