<?php

namespace App\Http\Controllers;

class OauthProvidersController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}