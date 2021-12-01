<?php

namespace App\Http\Controllers;

class OauthProvidersController extends Controller
{

	public function search() {
		return \App\Models\OauthProviders::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\OauthProviders::find($id);
	}

	public function save() {
		return (new \App\Models\OauthProviders)->store(request()->all());
	}

	public function valid() {
		return \App\Models\OauthProviders::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\OauthProviders::search()->remove();
	}

	public function clone($id) {
		return \App\Models\OauthProviders::find($id)->clone();
	}

	public function export() {
		return \App\Models\OauthProviders::search()->export();
	}
}