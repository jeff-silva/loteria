<?php

namespace App\Models;

class PasswordReset extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'email',
		'token',
		'created_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}
}