<?php

namespace App\Http\Controllers;

class FailedJobsController extends Controller
{

	public function search() {
		return \App\Models\FailedJobs::search()->paginate(request('per_page', 10));
	}

	public function find($id) {
		return \App\Models\FailedJobs::find($id);
	}

	public function save() {
		return (new \App\Models\FailedJobs)->store(request()->all());
	}

	public function valid() {
		return \App\Models\FailedJobs::new()->validate(request()->all());
	}

	public function remove() {
		return \App\Models\FailedJobs::search()->remove();
	}

	public function clone($id) {
		return \App\Models\FailedJobs::find($id)->clone();
	}

	public function export() {
		return \App\Models\FailedJobs::search()->export();
	}
}