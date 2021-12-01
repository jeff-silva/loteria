<?php

namespace App\Http\Controllers;

class EmailsController extends Controller
{

	public function search() {
		return \App\Models\Emails::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\Emails::find($id);
	}

	public function save() {
		return (new \App\Models\Emails)->store(request()->all());
	}

	public function valid() {
		return \App\Models\Emails::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\Emails::search()->remove();
	}

	public function clone($id) {
		return \App\Models\Emails::find($id)->clone();
	}

	public function export() {
		return \App\Models\Emails::search()->export();
	}
}