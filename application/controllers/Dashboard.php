<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$data['link_css'] = array('assets/css/smartstaff.css');
		
		/** para os filtros */
		if(isset($_GET['itens_pagina']) && !empty($_GET['itens_pagina'])) {
			$data['itens_pagina'] = (int)$_GET['itens_pagina'];
		} else {
			$data['itens_pagina'] = 5;
		}
		
		if(isset($_GET['data_de']) && !empty($_GET['data_de'])) {
			$data['data_de'] = $_GET['data_de'];
		} else {
			$data['data_de'] = 0;
		}
		
		if(isset($_GET['data_ate']) && !empty($_GET['data_ate'])) {
			$data['data_ate'] = $_GET['data_ate'];
		} else {
			$data['data_ate'] = 0;
		}

		$dados_json = $this->obter_dados_json($data['data_de'], $data['data_ate']);

		$data['numero_pagina'] = isset($_GET['numero_pagina'])&&!empty($_GET['numero_pagina'])?(int)$_GET['numero_pagina']-1:0;

		$data['tipo_ordenacao'] = isset($_GET['tipo_ordenacao'])&&!empty($_GET['tipo_ordenacao'])?$_GET['tipo_ordenacao']:0;

		if(!empty($data['tipo_ordenacao']) && !empty($dados_json)) {
			if($data['tipo_ordenacao'] === 'Menor Budget') {
				foreach($dados_json as $key => $value) {
					$valor_budget[] = $value->budget;
				}

				array_multisort($valor_budget, SORT_ASC, $dados_json);
			} else if($data['tipo_ordenacao'] === 'Maior Budget') {
				foreach($dados_json as $key => $value) {
					$valor_budget[] = $value->budget;
				}

				array_multisort($valor_budget, SORT_DESC, $dados_json);
			} else if($data['tipo_ordenacao'] === 'A - Z') {
				foreach($dados_json as $key => $value) {
					$first_names[] = $value->name->first;
					$last_names[] = $value->name->last;
				}

				array_multisort($first_names, SORT_ASC, $last_names, SORT_ASC, $dados_json);
			} else if($data['tipo_ordenacao'] === 'Z - A') {
				foreach($dados_json as $key => $value) {
					$first_names[] = $value->name->first;
					$last_names[] = $value->name->last;
				}

				array_multisort($first_names, SORT_DESC, $last_names, SORT_DESC, $dados_json);
			}
		}

		$data['dados_json'] = $dados_json;

		$this->load->view('dashboard', $data);
	}

	public function obter_dados_json($data_de = null, $data_ate = null) {
		$json = file_get_contents('https://smarts-totem.s3-sa-east-1.amazonaws.com/code-challenge/customers.json');

		$dados_json = json_decode($json);

		if(!empty($dados_json)) {
			if(!empty($data_de)) {
				$timeZone = new DateTimeZone('UTC');
				
				foreach($dados_json as $key => $value) {
					/** converter a data do json em d/m/Y */
					$data_json = date('d/m/Y', strtotime($value->registered));
					$data_de = date_format(DateTime::createFromFormat('d/m/Y', $data_de, $timeZone), 'd/m/Y');
					
					if(strtotime($data_json) < strtotime($data_de)) {
						unset($dados_json[$key]);
					}
				}
			}

			if(!empty($data_ate)) {
				$timeZone = new DateTimeZone('UTC');

				foreach($dados_json as $key => $value) {
					/** converter a data do json em d/m/Y */
					$data_json = date('d/m/Y', strtotime($value->registered));
					$data_ate = date_format(DateTime::createFromFormat('d/m/Y', $data_ate, $timeZone), 'd/m/Y');
					
					if(strtotime($data_json) > strtotime($data_ate)) {
						unset($dados_json[$key]);
					}
				}
			}
		}

		return $dados_json;
	}

	public function paginar_dados_json(){
		/** para testar */
		$json = file_get_contents('https://smarts-totem.s3-sa-east-1.amazonaws.com/code-challenge/customers.json');

		if(!empty($json)) {
			$data['dados_json'] = json_decode($json);
		} else {
			$data['dados_json'] = null;
		}

		if(isset($_GET['data_de']) && !empty($_GET['data_de'])) {
			$data['data_de'] = $_GET['data_de'];
		} else {
			$data['data_de'] = 0;
		}
		
		if(isset($_GET['data_ate']) && !empty($_GET['data_ate'])) {
			$data['data_ate'] = $_GET['data_ate'];
		} else {
			$data['data_ate'] = 0;
		}

		if(!empty($data['dados_json'])) {
			if(!empty($data['data_de'])) {
				$timeZone = new DateTimeZone('UTC');
				
				foreach($data['dados_json'] as $key => $value) {
					/** converter a data do json em d/m/Y */
					$data_json = date('d/m/Y', strtotime($value->registered));
					$data_de = date_format(DateTime::createFromFormat('d/m/Y', $data['data_de'], $timeZone), 'd/m/Y');
					
					if($data_json < $data_de) {
						unset($data['dados_json'][$key]);
					}
				}
			}

			if(!empty($data['data_ate'])) {
				$timeZone = new DateTimeZone('UTC');

				foreach($data['dados_json'] as $key => $value) {
					/** converter a data do json em d/m/Y */
					$data_json = date('d/m/Y', strtotime($value->registered));
					$data_ate = date_format(DateTime::createFromFormat('d/m/Y', $data['data_ate'], $timeZone), 'd/m/Y');
					
					if($data_json > $data_ate) {
						unset($data['dados_json'][$key]);
					}
				}
			}
		}

		$this->load->view('dados_json', $data);
	}
}
