<?php

namespace App\Http\Controllers;

class FailedJobsController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => [],
		]);
	}
	
}