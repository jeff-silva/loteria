<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{

	public function search() {
		return \App\Models\User::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\User::find($id);
	}

	public function save() {
		return (new \App\Models\User)->store(request()->all());
	}

	public function valid() {
		return \App\Models\User::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\User::search()->remove();
	}

	public function clone($id) {
		return \App\Models\User::find($id)->clone();
	}

	public function export() {
		return \App\Models\User::search()->export();
	}
}