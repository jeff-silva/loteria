<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
	static function router() {
		\Route::post('settings/save-all', 'App\Http\Controllers\SettingsController@saveAll');
		\Route::get('settings/get-all', 'App\Http\Controllers\SettingsController@getAll');
	}
	
	public function search() {
		return \App\Models\Settings::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\Settings::find($id);
	}

	public function save() {
		return (new \App\Models\Settings)->store(request()->all());
	}

	public function valid() {
		return \App\Models\Settings::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\Settings::search()->remove();
	}

	public function clone($id) {
		return \App\Models\Settings::find($id)->clone();
	}

	public function export() {
		return \App\Models\Settings::search()->export();
	}

	public function getAll() {
		return (new \App\Models\Settings)->getAll();
	}

	public function saveAll() {
		return (new \App\Models\Settings)->saveAll(request()->all());
	}
}