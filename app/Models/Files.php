<?php

namespace App\Models;

class Files extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'name',
		'slug',
		'mime',
		'ext',
		'size',
		'folder',
		'url',
		'base64',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $hidden = [
		'base64',
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	public function upload($field) {
		if (! request()->hasFile($field)) return false;
		
		$file = request()->file($field);
		$data['name'] = $file->getClientOriginalName();
		$data['slug'] = uniqid() .'.'. $file->extension();
		$data['mime'] = $file->getMimeType();
		$data['ext'] = $file->extension();
		$data['size'] = $file->getSize();
		$data['url'] = "/api/file/{$data['slug']}";
		$data['base64'] =  "data:{$data['mime']};base64,". base64_encode(file_get_contents($file));

		if ($data['ext']=='svg') {
			$data['mime'] = 'image/svg+xml';
		}

		return \App\Models\Files::create($data);
	}

	public function setFolderAttribute($value) {
		$this->attributes['folder'] = trim($value, '/');
	}
}