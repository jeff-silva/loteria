<?php

namespace App\Http\Controllers;

class EmailsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}