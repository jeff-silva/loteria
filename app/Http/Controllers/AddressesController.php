<?php

namespace App\Http\Controllers;

class AddressesController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}