<?php

namespace App\Http\Controllers;

class UsersNotificationsController extends Controller
{

	public function search() {
		return \App\Models\UsersNotifications::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\UsersNotifications::find($id);
	}

	public function save() {
		return (new \App\Models\UsersNotifications)->store(request()->all());
	}

	public function valid() {
		return \App\Models\UsersNotifications::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\UsersNotifications::search()->remove();
	}

	public function clone($id) {
		return \App\Models\UsersNotifications::find($id)->clone();
	}

	public function export() {
		return \App\Models\UsersNotifications::search()->export();
	}
}