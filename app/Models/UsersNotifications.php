<?php

namespace App\Models;

class UsersNotifications extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'user_id',
		'title',
		'body',
		'url',
		'image',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	public function user() {
		return $this->belongsTo(\App\Models\UsersNotifications::class, 'user_id', 'id');
	}
}