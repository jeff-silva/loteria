<?php

namespace App\Models;

class LoteriaSorteioBase extends \Illuminate\Database\Eloquent\Model
{
	use \App\Traits\Model;

	protected $fillable = [
		'id',
		'type',
		'number',
		'numbers',
		'created_at',
		'updated_at'
	];

	public $appends = [
		'type',
	];

	public function validate($data=[]) {
		return \Validator::make($data, [
			'name' => ['required'],
		]);
	}

	protected $type = [
		'id' => 'megasena',
		'name' => 'Mega-Sena',
		'numbers' => 6,
	];

	public function tiposAposta() {
		return collect([
			new \App\Models\LoteriaMegasena,
			new \App\Models\LoteriaLotofacil,
		]);
	}

	static function getInstance($type) {
		foreach((new self)->tiposAposta() as $tipoAposta) {
			if ($tipoAposta->type['id']==$type) {
				return $tipoAposta;
			}
		}
	}

	public function import() {
		$scraper_url = "http://loterias.caixa.gov.br/wps/portal/loterias/landing/{$this->type['id']}/";
		$page1 = (new \Goutte\Client())->request('GET', $scraper_url);
		$self = $this;

		$page1->filter('.title.zeta')->each(function($node) use($page1, $self) {
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
					if ($item = $self->importData($dom, $index)) {
						if (! $self->where('number', $item['number'])->first()) {
							$self->create($item);
						}
					}
				}
			}
		});
	}

	public function importData($tr, $index) {}

	public function getTypeAttribute() {
		return $this->type;
	}
}