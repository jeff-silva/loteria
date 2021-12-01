<?php

namespace App\Http\Controllers;

class AddressesController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}

	public function search() {
		return \App\Models\Addresses::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\Addresses::find($id);
	}

	public function save() {
		return (new \App\Models\Addresses)->store(request()->all());
	}

	public function valid() {
		return \App\Models\Addresses::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\Addresses::search()->remove();
	}

	public function clone($id) {
		return \App\Models\Addresses::find($id)->clone();
	}

	public function export() {
		return \App\Models\Addresses::search()->export(export('format', 'csv'));
	}
}