<?php

namespace App\Http\Controllers;

class PasswordResetsController extends Controller
{

	public function search() {
		return \App\Models\PasswordResets::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\PasswordResets::find($id);
	}

	public function save() {
		return (new \App\Models\PasswordResets)->store(request()->all());
	}

	public function valid() {
		return \App\Models\PasswordResets::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\PasswordResets::search()->remove();
	}

	public function clone($id) {
		return \App\Models\PasswordResets::find($id)->clone();
	}

	public function export() {
		return \App\Models\PasswordResets::search()->export();
	}
}