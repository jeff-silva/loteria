<?php

namespace App\Models;

class Migration extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'migration',
		'batch'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}
}