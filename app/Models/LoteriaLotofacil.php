<?php

namespace App\Models;

class LoteriaLotofacil extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'number',
		'numbers',
		'date',
		'created_at',
		'updated_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}
}