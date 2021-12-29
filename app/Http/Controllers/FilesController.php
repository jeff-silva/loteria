<?php

namespace App\Http\Controllers;

class FilesController extends Controller
{

	public function __construct() {
		$this->middleware('auth:api', [
			'except' => ['file', 'search'],
		]);
	}

	static function router() {
		\Route::post('files/upload', 'App\Http\Controllers\FilesController@upload');
	}
	
	public function search() {
		$search = \App\Models\Files::search()->paginate(request('per_page', 10))->toArray();
		$search['folders'] = \App\Models\Files::select(['folder'])->groupBy('folder')->get();
		return $search;
	}

	public function upload() {
		return (new \App\Models\Files)->upload('file');
	}

	public function file($slug) {
		$file = \Cache::remember("file-{$slug}", 60*30*24, function() use($slug) {
			return \App\Models\Files::where('slug', $slug)->first();
		});

		if (! $file) return '';

		$content = explode(',', $file->base64);
		$content = base64_decode($content[1]);
		
		if ($file->mime=='image/svg') {
			$file->mime = 'image/svg+xml';
		}

		return response($content)->withHeaders([
			'Content-Type' => $file->mime,
			// 'Cache-Control' => 'no-store, no-cache',
			// 'Content-Disposition' => 'attachment; filename="logs.txt',
		]);
	}
}