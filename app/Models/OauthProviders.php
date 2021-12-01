<?php

namespace App\Models;

class OauthProviders extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'user_id',
		'provider',
		'provider_user_id',
		'access_token',
		'refresh_token',
		'created_at',
		'updated_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	public function user() {
		return $this->belongsTo(\App\Models\OauthProviders::class, 'user_id', 'id');
	}
}