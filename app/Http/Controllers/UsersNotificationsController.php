<?php

namespace App\Http\Controllers;

class UsersNotificationsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}