<?php

namespace App\Models;

class LoteriaMegasena extends LoteriaSorteioBase
{
	use \App\Traits\Model;

	protected $table = 'loteria_megasena';

	protected $fillable = [
		'id',
		'number',
		'numbers',
		'date',
		'created_at',
		'updated_at'
	];

	protected $type = [
		'id' => 'megasena',
		'name' => 'Mega-Sena',
		'numbers' => 6,
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	public function importData($tr, $index) {
		$tds = $tr->getElementsByTagName('td');
		$item = [];

		if ($elem = $tds[0]) {
			$item['number'] = $elem->nodeValue;
			if (!$item['number']) return;
		}


		if ($elem = $tds[2]) {
			$item['date'] = \DateTime::createFromFormat('d/m/Y', $elem->nodeValue)->format('Y-m-d H:i:s');
		}

		$item['numbers'] = [];
		foreach(range(3, 8) as $range_index) {
			if ($tds[$range_index]) {
				$item['numbers'][] = str_pad(intval($tds[$range_index]->nodeValue), 2, '0', STR_PAD_LEFT);
			}
		}
		$item['numbers'] = implode(' ', $item['numbers']);

		if (!$item['numbers']) return;
		return $item;
	}
}