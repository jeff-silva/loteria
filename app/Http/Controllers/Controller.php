<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static function router() {
        // 
    }

    // /api/{$model}/search
    public function search() {
		return $this->model->search()->paginate(request('per_page', 10));
	}

    // /api/{$model}/find/123
	public function find($id) {
        return $this->model->firstOrNew(['id' => $id]);
	}

    // /api/{$model}/save
	public function save() {
		return $this->model->store(request()->all());
	}

    // /api/{$model}/valid
	public function valid() {
		return $this->model->validate(request()->all());
	}

    // /api/{$model}/remove
	public function remove() {
		return $this->model->search()->remove();
	}

    // /api/{$model}/clone/{$id}
	public function clone($id) {
		return $this->model->find($id)->clone();
	}

    // /api/{$model}/export
	public function export() {
		return $this->model->search()->export(export('format', 'csv'));
	}
}
