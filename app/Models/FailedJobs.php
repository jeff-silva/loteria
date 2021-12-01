<?php

namespace App\Models;

class FailedJobs extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'uuid',
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}
}