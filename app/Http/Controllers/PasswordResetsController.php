<?php

namespace App\Http\Controllers;

class PasswordResetsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}