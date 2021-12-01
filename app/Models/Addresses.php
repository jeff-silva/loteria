<?php

namespace App\Models;

class Addresses extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'name',
		'route',
		'number',
		'complement',
		'zipcode',
		'district',
		'city',
		'state',
		'st',
		'country',
		'co',
		'lat',
		'lng',
		'created_at',
		'updated_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'route' => ['required'],
		]);
	}

	public function users() {
		return $this->hasMany(\App\Models\Addresses::class, 'address_id', 'id');
	}
}