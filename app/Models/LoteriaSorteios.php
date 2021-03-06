<?php

namespace App\Models;

class LoteriaSorteios extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'slug',
		'type',
		'number',
		'numbers',
		'date',
		'created_at',
		'updated_at'
	];

	protected $appends = [
		'numbersData',
	];

	public function getNumbersDataAttribute() {
		return explode(' ', $this->attributes['numbers']);
	}

	public function validate($data=[]) {
		return \Validator::make($data, [
			// 'name' => ['required'],
		]);
	}

	static function sorteioTypes() {
		/*
		id: 
		name: 
		numbersSelect: 
		numbersTotal: 
		tableNumberStart: 
		tableNumberFinal: 
		tableNumberLine: 
		*/

		$default = [
			'id' => 'id',
			'name' => 'name',
			'numbersSelectMin' => 10,
			'numbersSelectMax' => 20,
			'tableNumberStart' => 1,
			'tableNumberFinal' => 100,
			'tableNumberLine' => 10,
		];
		
		$types[] = array_merge($default, [
			'id' => 'megasena',
			'name' => 'Mega Sena',
			'link' => 'http://www.loterias.caixa.gov.br/wps/portal/loterias/landing/megasena/',
			'tableNumberStart' => 1,
			'tableNumberFinal' => 60,
			'tableNumberLine' => 10,
			'importer' => function($tr, $index) {
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
			},
		]);

		$types[] = array_merge($default, [
			'id' => 'lotofacil',
			'name' => 'Loto Fácil',
			'link' => 'http://www.loterias.caixa.gov.br/wps/portal/loterias/landing/lotofacil/',
			'tableNumberStart' => 1,
			'tableNumberFinal' => 25,
			'tableNumberLine' => 5,
			'importer' => function($tr, $index) {
				$tds = $tr->getElementsByTagName('td');
				$item = [];

				if ($elem = $tds[0]) {
					$item['number'] = $elem->nodeValue;
					if (!$item['number']) return;
				}

				if ($elem = $tds[1]) {
					$item['date'] = \DateTime::createFromFormat('d/m/Y', $elem->nodeValue)->format('Y-m-d H:i:s');
				}

				$item['numbers'] = [];
				foreach(range(2, 16) as $range_index) {
					if ($tds[$range_index]) {
						$item['numbers'][] = str_pad(intval($tds[$range_index]->nodeValue), 2, '0', STR_PAD_LEFT);
					}
				}
				
				$item['numbers'] = implode(' ', $item['numbers']);
				if (!$item['numbers']) return;
				return $item;
			},
		]);

		return $types;
	}

	static function sorteioType($id) {
		foreach(self::sorteioTypes() as $type) {
			if ($id == $type['id']) {
				return $type;
			}
		}

		return false;
	}

	static function sorteioSync($types=[]) {
		$returns = [];

		if (empty($types)) {
			foreach(self::sorteioTypes() as $type) {
				$types[] = $type['id'];
			}
		}

		
		foreach($types as $type) {
			if ($type = self::sorteioType($type)) {
				$self = new self;
				$scraper_url = "http://loterias.caixa.gov.br/wps/portal/loterias/landing/{$type['id']}/";
				$page1 = (new \Goutte\Client())->request('GET', $scraper_url);

				$return = $page1->filter('.title.zeta')->each(function($node) use($page1, $self, $scraper_url, $type, $returns) {
					$result_page = implode('', [
						$page1->getBaseHref(),
						collect($node->extract(['href']))->first(),
					]);
		
					$page2 = (new \GuzzleHttp\Client)->get($result_page, [
						'cookies' => new \GuzzleHttp\Cookie\CookieJar,
						'allow_redirects' => true,
					])->getBody()->getContents();
		
					preg_match_all('/\<tr.+?\>(.+?)\<\/tr\>/s', $page2, $all);
					if (isset($all[1])) {
						foreach($all[1] as $index => $value) {
							$dom = new \DOMDocument;
							@$dom->loadHTML($value);
							$dom->preserveWhiteSpace = false;
							if ($item = $type['importer']($dom, $index)) {
								$item['slug'] = "{$type['id']}-{$item['number']}";
								$item['type'] = $type['id'];

								// $items[] = self::firstOrCreate(['slug' => $item['slug']], $item);
							}
						}
					}

					return [
						'page1_url' => $scraper_url,
						'page2_url' => $result_page,
					];
				});

				// $return = $return[0];
				$return['type'] = $type;
				$returns[] = $return;
			}
		}

		return $returns;
	}

	public function sorteioAnalysis($typeid, $numbers) {
		if ($type = self::sorteioType($typeid)) {
			if (empty($numbers)) { return []; }
			return (new self)->where('type', $typeid)
				->withNumbers($numbers)
				->orderBy('id', 'desc')
				->get();
		}

		return false;
	}

	public function scopeWithNumbers($query, $numbers=[]) {
		if (empty($numbers)) return $query;
		return $query->where(function($q) use($numbers) {
			foreach($numbers as $number) {
				$q->where('numbers', 'like', "%{$number}%");
			}
		});
	}
}