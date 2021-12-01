<?php

namespace App\Models;

class Settings extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'name',
		'value',
		'model',
		'created_at',
		'updated_at'
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	public function saveAll($data=[]) {
		$return = [];
		foreach($data as $name=>$value) {
			$this->firstOrNew(['name' => $name])->fill(['value' => $value])->save();
			$return[ $name ] = $value;
		}
		return $return;
	}

	public function getAll() {
		return (object) self::select(['name', 'value'])->get()->pluck('value', 'name')->toArray();
	}
}